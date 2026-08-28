<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use App\Models\JenisMakanan;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);
        $keyword = $request->input('search');

        $products = Produk::with('jenisMakanan')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('produk.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Produk::class);
        $jenisMakanans = JenisMakanan::orderBy('nama')->get();
        return view('produk.create', compact('jenisMakanans'));
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);
        $dataReq = $request->validated();

        $data = [
            'user_id'          => Auth::id(),
            'nama'             => $dataReq['name'],
            'jenis_makanan_id' => $dataReq['jenis_makanan_id'],
            'harga_beli'       => $dataReq['purchase_price'],
            'harga_jual'       => $dataReq['selling_price'],
            'stok'             => $dataReq['stock'] ?? 0,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);
        $jenisMakanans = JenisMakanan::orderBy('nama')->get();
        return view('produk.edit', compact('produk', 'jenisMakanans'));
    }

    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);
        $dataReq = $request->validated();

        $data = [
            'user_id'          => Auth::id(),
            'nama'             => $dataReq['name'],
            'jenis_makanan_id' => $dataReq['jenis_makanan_id'],
            'harga_beli'       => $dataReq['purchase_price'],
            'harga_jual'       => $dataReq['selling_price'],
            'stok'             => $dataReq['stock'],
        ];

        if ($request->hasFile('foto')) {
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk) 
    {
        $this->authorize('delete', $produk);

        try {
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }
            $produk->delete();

            return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000' || $e->errorInfo[1] === 1451) {
                return redirect()->route('produk.index')->with('error', 'Produk tidak dapat dihapus karena memiliki riwayat transaksi.');
            }
            return redirect()->route('produk.index')->with('error', 'Terjadi kesalahan saat menghapus.');
        }
    }
}