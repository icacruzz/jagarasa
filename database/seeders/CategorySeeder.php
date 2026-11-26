<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Keripik Pisang',
                'deskripsi'     => 'Camilan keripik pisang kepok aneka rasa khas Lampung renyah dan gurih.',
            ],
            [
                'nama_kategori' => 'Keripik Singkong',
                'deskripsi'     => 'Olahan singkong lokal pilihan dengan varian bumbu pedas manis dan rempah.',
            ],
            [
                'nama_kategori' => 'Kemplang & Olahan Ikan',
                'deskripsi'     => 'Kerupuk kemplang panggang ikan tenggiri asli dengan sambal terasi khas.',
            ],
            [
                'nama_kategori' => 'Kopi Lampung',
                'deskripsi'     => 'Biji kopi Robusta petik merah pilihan dari lereng pegunungan Lampung.',
            ],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['nama_kategori' => $cat['nama_kategori']],
                [
                    'slug'      => Str::slug($cat['nama_kategori']),
                    'deskripsi' => $cat['deskripsi'],
                ]
            );
        }
    }
}
