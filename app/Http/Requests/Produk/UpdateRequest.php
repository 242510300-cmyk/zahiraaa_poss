<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name'             => 'required|string|max:255',
            // Jika nama tabel di database adalah 'jenis_makanan', sesuaikan di bawah:
            'jenis_makanan_id' => 'required|exists:jenis_makanan,id', 
            'purchase_price'   => 'required|integer|min:0',
            'selling_price'    => 'required|integer|min:0',
            'stock'            => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'foto.image'                => 'File yang diupload harus gambar.',
            'foto.mimes'                => 'Extensi gambar harus JPG, JPEG, PNG.',
            'foto.max'                  => 'Maksimal ukuran gambar 2MB.',
            'name.required'             => 'Nama wajib diisi.',
            'jenis_makanan_id.required' => 'Jenis makanan wajib dipilih.',
            'jenis_makanan_id.exists'   => 'Jenis makanan yang dipilih tidak valid.',
            'purchase_price.required'   => 'Harga beli wajib diisi.',
            'purchase_price.integer'    => 'Harga beli harus diisi angka.',
            'selling_price.required'    => 'Harga jual wajib diisi.',
            'selling_price.integer'     => 'Harga jual harus diisi angka.',
            'stock.required'            => 'Stok wajib diisi.',
            'stock.integer'             => 'Stok harus diisi angka.',
        ];
    }
}