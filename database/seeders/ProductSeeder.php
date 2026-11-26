<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'kategori'    => 'Keripik Pisang',
                'nama_produk' => 'Keripik Pisang Kepok Cokelat Lumer',
                'slug'        => 'keripik-pisang-kepok-cokelat-lumer',
                'harga'       => 28000,
                'stok'        => 45,
                'berat_gram'  => 250,
                'deskripsi'   => 'Keripik pisang kepok pilihan khas Lampung yang dipotong tipis renyah dan dibalut bubuk cokelat premium tebal yang lumer di mulut.',
                'gambar'      => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=700&auto=format&fit=crop&q=80',
            ],
            [
                'kategori'    => 'Keripik Pisang',
                'nama_produk' => 'Keripik Pisang Kepok Rasa Keju Susu',
                'slug'        => 'keripik-pisang-kepok-rasa-keju-susu',
                'harga'       => 28000,
                'stok'        => 30,
                'berat_gram'  => 250,
                'deskripsi'   => 'Perpaduan gurihnya keju dan manisnya susu bubuk yang membalut sempurna keripik pisang kepok kuning asli Pesawaran, Lampung.',
                'gambar'      => 'https://images.unsplash.com/photo-1599490659213-e2b9527bd087?w=700&auto=format&fit=crop&q=80',
            ],
            [
                'kategori'    => 'Keripik Singkong',
                'nama_produk' => 'Keripik Singkong Balado Pedas Manis',
                'slug'        => 'keripik-singkong-balado-pedas-manis',
                'harga'       => 20000,
                'stok'        => 50,
                'berat_gram'  => 200,
                'deskripsi'   => 'Singkong lokal pilihan yang digoreng garing lalu dimasak dengan bumbu karamel cabai merah asli, menghasilkan sensasi pedas manis yang bikin ketagihan.',
                'gambar'      => 'https://images.unsplash.com/photo-1566478989037-eec170784d0b?w=700&auto=format&fit=crop&q=80',
            ],
            [
                'kategori'    => 'Kemplang & Olahan Ikan',
                'nama_produk' => 'Kemplang Panggang Ikan Tenggiri + Sambal Terasi',
                'slug'        => 'kemplang-panggang-ikan-tenggiri-sambal-terasi',
                'harga'       => 32000,
                'stok'        => 25,
                'berat_gram'  => 200,
                'deskripsi'   => 'Kerupuk kemplang tradisional yang dipanggang di atas bara api tanpa minyak, terbuat dari ikan tenggiri segar lengkap dengan sambal terasi khas Lampung di dalam kemasan.',
                'gambar'      => 'https://images.unsplash.com/photo-1541592106381-b31e9677c0e5?w=700&auto=format&fit=crop&q=80',
            ],
            [
                'kategori'    => 'Kopi Lampung',
                'nama_produk' => 'Kopi Bubuk Robusta Lampung Barat (Fine Grind)',
                'slug'        => 'kopi-bubuk-robusta-lampung-barat-fine-grind',
                'harga'       => 35000,
                'stok'        => 40,
                'berat_gram'  => 200,
                'deskripsi'   => 'Biji kopi Robusta petik merah dari dataran tinggi Liwa, Lampung Barat. Memiliki aroma cokelat yang kuat, body tebal, dan rasa pahit yang mantap.',
                'gambar'      => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=700&auto=format&fit=crop&q=80',
            ],

        ];

        foreach ($products as $p) {
            $cat = Category::where('nama_kategori', $p['kategori'])->first();
            if ($cat) {
                Product::updateOrCreate(
                    ['slug' => $p['slug']],
                    [
                        'category_id' => $cat->id,
                        'nama_produk' => $p['nama_produk'],
                        'harga'       => $p['harga'],
                        'stok'        => $p['stok'],
                        'berat_gram'  => $p['berat_gram'],
                        'deskripsi'   => $p['deskripsi'],
                        'gambar'      => $p['gambar'],
                    ]
                );
            }
        }
    }
}
