<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name'     => 'Admin SantapKita',
            'email'    => 'admin@santapkita.com',
            'password' => Hash::make('admin123'),
            'phone'    => '081234567890',
            'address'  => 'Jl. Admin No. 1, Jakarta',
            'role'     => 'admin',
        ]);

        // Create Categories
        $categories = [
            ['category_name' => 'Paket Harian'],
            ['category_name' => 'Paket Kantor'],
            ['category_name' => 'Paket Acara'],
            ['category_name' => 'Paket Premium'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Packages
        $packages = [
            [
                'category_id'  => 1,
                'package_name' => 'Nasi Kotak Harian',
                'description'  => 'Paket nasi kotak untuk kebutuhan harian dengan lauk bergizi. Terdiri dari nasi putih, ayam goreng/bakar, tempe orek, sayur bening, kerupuk, dan buah potong. Cocok untuk sarapan atau makan siang.',
                'price'        => 25000,
                'image'        => null,
            ],
            [
                'category_id'  => 1,
                'package_name' => 'Nasi Bento Hemat',
                'description'  => 'Paket bento ekonomis dengan menu lengkap dan bergizi. Terdiri dari nasi, protein pilihan (ayam/ikan/telur), sayuran, dan sambal. Dikemas dalam kotak bento cantik.',
                'price'        => 20000,
                'image'        => null,
            ],
            [
                'category_id'  => 2,
                'package_name' => 'Paket Makan Siang Kantor',
                'description'  => 'Paket catering khusus kantor dengan variasi menu mingguan. Tersedia untuk minimal 10 porsi. Menu berganti setiap hari dengan lauk yang berbeda agar tidak monoton.',
                'price'        => 35000,
                'image'        => null,
            ],
            [
                'category_id'  => 2,
                'package_name' => 'Paket Snack Meeting',
                'description'  => 'Paket snack dan minuman untuk rapat/meeting kantor. Termasuk berbagai kue tradisional, gorengan, teh, kopi, dan air mineral. Minimal order 20 porsi.',
                'price'        => 15000,
                'image'        => null,
            ],
            [
                'category_id'  => 3,
                'package_name' => 'Paket Pernikahan Gold',
                'description'  => 'Paket catering pernikahan lengkap dengan menu prasmanan. Termasuk 12 jenis masakan, 3 jenis minuman, dekorasi meja makan, dan pelayan. Minimal 100 porsi.',
                'price'        => 95000,
                'image'        => null,
            ],
            [
                'category_id'  => 3,
                'package_name' => 'Paket Ulang Tahun',
                'description'  => 'Paket catering lengkap untuk perayaan ulang tahun. Terdiri dari berbagai hidangan lezat, kue ulang tahun, dan dekorasi sederhana. Minimal 30 porsi.',
                'price'        => 75000,
                'image'        => null,
            ],
            [
                'category_id'  => 4,
                'package_name' => 'Premium Box Wagyu',
                'description'  => 'Paket nasi kotak premium dengan daging wagyu pilihan. Terdiri dari nasi premium, wagyu steak medium, salad caesar, sup krim, roti, dan dessert. Kemasan eksklusif.',
                'price'        => 150000,
                'image'        => null,
            ],
            [
                'category_id'  => 4,
                'package_name' => 'Premium Set Seafood',
                'description'  => 'Paket makan seafood premium dengan bahan-bahan segar pilihan. Terdiri dari lobster butter garlic, udang bakar, cumi goreng tepung, ikan kakap saus padang, dan nasi putih pulen.',
                'price'        => 200000,
                'image'        => null,
            ],
        ];

        foreach ($packages as $pkg) {
            Package::create($pkg);
        }
    }
}
