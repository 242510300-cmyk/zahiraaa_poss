<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\ItemPenjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Tampilan daftar riwayat penjualan.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $penjualans = Penjualan::query()
            ->when($user->role && $user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('penjualans'));
    }

    /**
     * Tampilkan detail satu transaksi penjualan.
     */
    public function show(Penjualan $penjualan)
    {
        $penjualan->load('itemPenjualan.produk', 'user');

        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Cetak struk transaksi.
     */
    public function struk(Penjualan $penjualan)
    {
        $penjualan->load('itemPenjualan.produk', 'user');

        return view('penjualan.struk', compact('penjualan'));
    }

    /**
     * Membuka halaman POS / Kasir.
     * Mengambil transaksi OPEN yang ada atau membuat draft baru.
     */
    public function create(SearchRequest $request)
    {
        // Cari transaksi berstatus OPEN milik kasir yang login, jika tidak ada buat baru
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status'  => 'OPEN',
            ],
            [
                'total_pembayaran'  => 0,
                'metode_pembayaran' => 'CASH',
            ]
        );

        // Load item keranjang dan produknya
        $sale->load('itemPenjualan.produk');

        // Pencarian produk di halaman POS
        $keyword = $request->input('search');
        $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Menambahkan produk ke keranjang transaksi (Aksi tombol +).
     */
    public function addItem(Request $request, Penjualan $penjualan)
    {
        // Mendukung input 'quantity' maupun 'kuantitas'
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'quantity'  => 'nullable|integer|min:1',
            'kuantitas' => 'nullable|integer|min:1',
        ]);

        // Ambil jumlah kuantitas yang dikirim
        $qty = $request->input('quantity') ?? $request->input('kuantitas') ?? 1;

        $produk = Produk::findOrFail($request->produk_id);

        // 1. Cek stok produk
        if ($produk->stok < $qty) {
            return back()->with('error', 'Stok produk tidak mencukupi!');
        }

        DB::transaction(function () use ($penjualan, $produk, $qty) {
            // 2. Cek apakah produk sudah ada di keranjang transaksi ini
            $item = $penjualan->itemPenjualan()->where('produk_id', $produk->id)->first();

            // Ambil harga dari atribut harga_jual (fallback ke harga jika harga_jual null)
            $hargaJual = $produk->harga_jual ?? $produk->harga ?? 0;

            if ($item) {
                // Jika sudah ada, tambahkan kuantitas dan kalkulasi subtotal baru
                $newQty = $item->kuantitas + $qty;
                $item->update([
                    'kuantitas' => $newQty,
                    'subtotal'  => $newQty * $hargaJual,
                ]);
            } else {
                // Jika belum ada, buat baris baru di tabel item_penjualan
                // 'produk_id' wajib dikirim agar tidak NULL
                $penjualan->itemPenjualan()->create([
                    'produk_id' => $produk->id,
                    'kuantitas' => $qty,
                    'harga'     => $hargaJual,
                    'harga_satuan' => $hargaJual,
                    'subtotal'  => $qty * $hargaJual,
                ]);
            }

            // 3. Kurangi stok produk
            $produk->decrement('stok', $qty);
        });

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Paksa membuat transaksi OPEN baru.
     */
    public function store(Request $request)
    {
        $sale = Penjualan::create([
            'user_id'           => Auth::id(),
            'status'            => 'OPEN',
            'total_pembayaran'  => 0,
            'metode_pembayaran' => 'CASH',
        ]);

        return redirect()->route('penjualan.edit', $sale->id)
            ->with('success', 'Transaksi baru berhasil dibuat!');
    }

    /**
     * Edit transaksi OPEN tertentu.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        // Cegah edit jika transaksi sudah COMPLETED
        if ($sale->status === 'COMPLETED') {
            return redirect()->route('penjualan.index')
                ->with('error', 'Transaksi yang sudah selesai tidak dapat diubah.');
        }

        $sale->load('itemPenjualan.produk');
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Selesaikan Transaksi (Checkout).
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method' => 'required|in:CASH,'
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        DB::transaction(function () use ($penjualan, $request) {
            $total = $penjualan->itemPenjualan()->sum('subtotal');

            $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran'  => $total,
                'status'            => 'COMPLETED'
            ]);
        });

        return redirect()
            ->route('penjualan.struk', $penjualan->id)
            ->with('success', 'Transaksi berhasil diselesaikan.');
    }

    /**
     * Batalkan Transaksi.
     */
    public function destroy(Penjualan $penjualan)
    {
        if ($penjualan->status !== 'OPEN') {
            return redirect()->route('penjualan.index')
                ->with('error', 'Transaksi sudah selesai, tidak bisa dibatalkan.');
        }

        DB::transaction(function () use ($penjualan) {
            // Kembalikan stok produk
            foreach ($penjualan->itemPenjualan as $item) {
                if ($item->produk) {
                    $item->produk->increment('stok', $item->kuantitas);
                }
            }

            // Hapus item keranjang & data penjualan
            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan.');
    }
}