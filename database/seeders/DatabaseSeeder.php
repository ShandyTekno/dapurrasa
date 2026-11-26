<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@dapurrasa.com'],
            ['name' => 'Admin DapurRasa', 'password' => Hash::make('admin12345')]
        );

        $kategori = [];
        foreach ([
            'Nasi Kotak' => 'Nasi kotak praktis untuk rapat, kantor, dan acara.',
            'Paket Catering' => 'Paket lengkap untuk kebutuhan katering harian.',
            'Lauk Pauk' => 'Aneka lauk pauk siap saji.',
            'Makanan Tradisional' => 'Hidangan tradisional khas Nusantara.',
            'Paket Acara' => 'Paket spesial untuk pernikahan, ulang tahun, dan syukuran.',
        ] as $nama => $desk) {
            $kategori[$nama] = Kategori::firstOrCreate(['nama_kategori' => $nama], ['deskripsi' => $desk]);
        }

        $menus = [
            ['Nasi Ayam Bakar', 'Nasi Kotak', 25000, 'Nasi putih dengan ayam bakar bumbu kecap, lalapan, sambal, dan kerupuk.'],
            ['Nasi Ayam Goreng', 'Nasi Kotak', 23000, 'Nasi putih dengan ayam goreng kremes, lalapan, dan sambal terasi.'],
            ['Nasi Rendang', 'Nasi Kotak', 32000, 'Nasi dengan rendang daging sapi empuk, sayur singkong, dan sambal hijau.'],
            ['Nasi Telur Balado', 'Nasi Kotak', 20000, 'Nasi dengan telur balado pedas manis, tumis buncis, dan kerupuk.'],
            ['Nasi Ikan Bakar', 'Nasi Kotak', 28000, 'Nasi dengan ikan bakar bumbu rempah, lalapan, dan sambal dabu-dabu.'],
            ['Paket Catering Hemat', 'Paket Catering', 450000, 'Paket untuk 20 porsi: nasi, ayam, sayur, kerupuk, dan buah.'],
            ['Paket Catering Premium', 'Paket Catering', 1250000, 'Paket untuk 40 porsi: nasi, dua lauk utama, sayur, sambal, dessert, dan air mineral.'],
            ['Ayam Geprek', 'Lauk Pauk', 18000, 'Ayam crispy digeprek dengan sambal bawang level pedas pilihan.'],
            ['Nasi Liwet', 'Makanan Tradisional', 30000, 'Nasi liwet gurih dengan ayam suwir, telur pindang, tahu tempe, dan lalapan.'],
            ['Nasi Kuning', 'Paket Acara', 35000, 'Nasi kuning dengan ayam goreng, telur dadar iris, orek tempe, dan sambal kacang.'],
        ];

        foreach ($menus as [$nama, $kat, $harga, $desk]) {
            Menu::firstOrCreate(
                ['nama_menu' => $nama],
                ['kategori_id' => $kategori[$kat]->id, 'harga' => $harga, 'deskripsi' => $desk]
            );
        }
    }
}
