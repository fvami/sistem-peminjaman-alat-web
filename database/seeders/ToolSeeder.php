<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tools')->insert([
            // Kategori 1 - Perkakas
            ['category_id' => 1, 'name' => 'Bor Listrik', 'description' => 'Bor listrik', 'stock' => 10, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 1, 'name' => 'Gerinda', 'description' => 'Gerinda tangan', 'stock' => 6, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 1, 'name' => 'Obeng Set', 'description' => 'Set obeng lengkap', 'stock' => 8, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],

            // Kategori 2 - Alat Berat Ringan
            ['category_id' => 2, 'name' => 'Molen Beton', 'description' => 'Mesin aduk semen', 'stock' => 2, 'status' => 'maintenance', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'name' => 'Jack Hammer', 'description' => 'Pemecah beton', 'stock' => 1, 'status' => 'unavailable', 'image' => null, 'created_at' => now(), 'updated_at' => now()],

            // Kategori 3 - Listrik
            ['category_id' => 3, 'name' => 'Genset', 'description' => 'Genset portable', 'stock' => 3, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 3, 'name' => 'Kabel Roll', 'description' => 'Kabel roll', 'stock' => 7, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],

            // Kategori 4 - Audio
            ['category_id' => 4, 'name' => 'Speaker Aktif', 'description' => 'Speaker', 'stock' => 4, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 4, 'name' => 'Microphone', 'description' => 'Mic kabel', 'stock' => 6, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],

            // Kategori 5 - Multimedia
            ['category_id' => 5, 'name' => 'Proyektor', 'description' => 'Proyektor', 'stock' => 3, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 5, 'name' => 'Tripod', 'description' => 'Tripod kamera', 'stock' => 5, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
