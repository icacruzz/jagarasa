<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_produk' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'harga'       => 'required|numeric|min:1000',
            'stok'        => 'required|integer|min:0',
            'berat_gram'  => 'required|integer|min:10',
            'deskripsi'   => 'required|string|max:1000',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    /**
     * Custom messages for validation
     */
    public function messages(): array
    {
        return [
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'category_id.required' => 'Silakan pilih kategori produk.',
            'category_id.exists'   => 'Kategori yang dipilih tidak valid.',
            'harga.required'       => 'Harga produk wajib diisi.',
            'harga.min'            => 'Harga minimal Rp 1.000.',
            'stok.required'        => 'Stok wajib diisi.',
            'berat_gram.required'  => 'Berat bersih dalam gram wajib diisi.',
            'deskripsi.required'   => 'Deskripsi produk wajib diisi.',
            'gambar.image'         => 'File harus berupa gambar.',
            'gambar.mimes'         => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'gambar.max'           => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
