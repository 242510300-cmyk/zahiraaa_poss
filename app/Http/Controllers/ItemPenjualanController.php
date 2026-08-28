<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPenjualanController extends Controller
{
    /**
     * Tambah produk ke keranjang
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'nullable|exists:produk,id',
            'produk_id'  => 'nullable|exists:produk,id',
            'quantity'   => 'nullable|integer|min:1',
            'kuantitas'  => 'nullable|integer|min:1',
        ]);

        $productId = $request->input('product_id') ?? $request->input('produk_id');
        $qty       = $request->input('quantity') ?? $request->input('kuantitas') ?? 1;

        if (!$productId) {
            return back()->with('error', 'Produk tidak ditemukan.');
        }

        try {
            DB::transaction(function () use ($productId, $qty) {
                // Ambil transaksi OPEN user aktif
                $penjualan = Penjualan::where('user_id', Auth::id())
                    ->where('status', 'OPEN')
                    ->lockForUpdate()
                    ->firstOrFail();

                // Ambil produk
                $produk = Produk::lockForUpdate()->findOrFail($productId);

                // Cek stok
                if ($produk->stok < $qty) {
                    throw new \Exception('Stok produk tidak mencukupi.');
                }

                // Ambil harga produk
                $harga = $produk->harga_jual ?? $produk->harga ?? 0;

                if (!$harga || $harga <= 0) {
                    throw new \Exception('Harga jual produk belum tersedia.');
                }

                // Cek apakah produk sudah ada di keranjang
                $item = ItemPenjualan::where('penjualan_id', $penjualan->id)
                    ->where('produk_id', $produk->id)
                    ->lockForUpdate()
                    ->first();

                if ($item) {
                    // Jika sudah ada, tambah kuantitas & subtotal
                    $newQty = $item->kuantitas + $qty;
                    $item->update([
                        'kuantitas'    => $newQty,
                        'harga_satuan' => $harga,
                        'harga'        => $harga,
                        'subtotal'     => $newQty * $harga,
                    ]);
                } else {
                    // Jika belum ada, buat item baru
                    ItemPenjualan::create([
                        'penjualan_id' => $penjualan->id,
                        'produk_id'    => $produk->id,
                        'kuantitas'    => $qty,
                        'harga_satuan' => $harga,
                        'harga'        => $harga,
                        'subtotal'     => $qty * $harga,
                    ]);
                }

                // Kurangi stok produk
                $produk->decrement('stok', $qty);

                // Update total pembayaran di tabel penjualan
                $total = ItemPenjualan::where('penjualan_id', $penjualan->id)->sum('subtotal');
                $penjualan->update([
                    'total_pembayaran' => $total,
                ]);
            });

            return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update jumlah barang di keranjang
     */
    public function update(Request $request, ItemPenjualan $itempenjualan)
    {
        $request->validate([
            'quantity'  => 'nullable|integer|min:1',
            'kuantitas' => 'nullable|integer|min:1',
        ]);

        $baru = $request->input('quantity') ?? $request->input('kuantitas') ?? 1;

        try {
            DB::transaction(function () use ($baru, $itempenjualan) {
                $produk = Produk::lockForUpdate()->find($itempenjualan->produk_id);

                $lama = $itempenjualan->kuantitas;
                $selisih = $baru - $lama;

                // Jika kuantitas bertambah
                if ($selisih > 0) {
                    if (!$produk || $produk->stok < $selisih) {
                        throw new \Exception('Stok produk tidak mencukupi.');
                    }
                    $produk->decrement('stok', $selisih);
                }

                // Jika kuantitas berkurang
                if ($selisih < 0 && $produk) {
                    $produk->increment('stok', abs($selisih));
                }

                $harga = $produk->harga_jual ?? $itempenjualan->harga_satuan ?? $itempenjualan->harga ?? 0;

                $itempenjualan->update([
                    'kuantitas'    => $baru,
                    'harga_satuan' => $harga,
                    'harga'        => $harga,
                    'subtotal'     => $baru * $harga,
                ]);

                // Update total pembayaran di penjualan
                $penjualan = $itempenjualan->penjualan;
                if ($penjualan) {
                    $penjualan->update([
                        'total_pembayaran' => $penjualan->itemPenjualan()->sum('subtotal'),
                    ]);
                }
            });

            return back()->with('success', 'Jumlah barang berhasil diperbarui.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Hapus item dari keranjang
     */
    public function destroy(ItemPenjualan $itempenjualan)
    {
        try {
            DB::transaction(function () use ($itempenjualan) {
                $produk = $itempenjualan->produk;
                $penjualan = $itempenjualan->penjualan;

                // Kembalikan stok produk
                if ($produk) {
                    $produk->increment('stok', $itempenjualan->kuantitas);
                }

                // Hapus item
                $itempenjualan->delete();

                // Recalculate total pembayaran
                if ($penjualan) {
                    $penjualan->update([
                        'total_pembayaran' => $penjualan->itemPenjualan()->sum('subtotal'),
                    ]);
                }
            });

            return back()->with('success', 'Produk berhasil dihapus dari keranjang.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}