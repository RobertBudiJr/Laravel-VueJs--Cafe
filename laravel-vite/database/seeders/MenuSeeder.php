<?php

namespace Database\Seeders;

use App\Models\Menu;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'nama_menu' => 'Ayam Bakar',
                'jenis' => 'makanan',
                'deskripsi' => 'Ayam terbakar',
                'gambar' => 'localhost/',
                'harga' => '12000'
            ],
            [
                'nama_menu' => 'Jus Jeruk',
                'jenis' => 'minuman',
                'deskripsi' => 'Jeruk dijus',
                'gambar' => 'localhost/',
                'harga' => '3000'
            ],
            [
                'nama_menu' => 'Ayam Balado',
                'jenis' => 'makanan',
                'deskripsi' => 'Ayam terbalado',
                'gambar' => 'localhost/',
                'harga' => '10000'
            ],
            [
                'nama_menu' => 'Es Teh',
                'jenis' => 'minuman',
                'deskripsi' => 'Teh dies',
                'gambar' => 'localhost/',
                'harga' => '2000'
            ],
        ];

        foreach ($menus as $key => $menu) {
            Menu::create($menu);
        }
    }
}
