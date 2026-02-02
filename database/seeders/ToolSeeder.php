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
            ['category_id' => 1, 'name' => 'Bor Listrik', 'description' => 'Bor listrik serbaguna', 'stock' => 10, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 1, 'name' => 'Gerinda', 'description' => 'Gerinda potong besi', 'stock' => 6, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 1, 'name' => 'Gergaji Mesin', 'description' => 'Gergaji kayu listrik', 'stock' => 4, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 1, 'name' => 'Obeng Listrik', 'description' => 'Obeng otomatis', 'stock' => 8, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],

            ['category_id' => 2, 'name' => 'Molen Beton', 'description' => 'Mesin aduk semen', 'stock' => 2, 'status' => 'maintenance', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'name' => 'Stamper Tanah', 'description' => 'Pemadat tanah', 'stock' => 3, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'name' => 'Vibrator Beton', 'description' => 'Pemadat beton', 'stock' => 2, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'name' => 'Jack Hammer', 'description' => 'Mesin pemecah beton', 'stock' => 1, 'status' => 'unavailable', 'image' => null, 'created_at' => now(), 'updated_at' => now()],

            ['category_id' => 3, 'name' => 'Genset 3000W', 'description' => 'Genset portable', 'stock' => 3, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 3, 'name' => 'Genset 5000W', 'description' => 'Genset daya besar', 'stock' => 2, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 3, 'name' => 'Kabel Roll', 'description' => 'Kabel roll 50 meter', 'stock' => 7, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 3, 'name' => 'Stabilizer Listrik', 'description' => 'Penstabil arus listrik', 'stock' => 4, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],

            ['category_id' => 4, 'name' => 'Speaker Aktif', 'description' => 'Speaker aktif 15 inch', 'stock' => 4, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 4, 'name' => 'Mixer Audio', 'description' => 'Mixer sound system', 'stock' => 2, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 4, 'name' => 'Microphone Wireless', 'description' => 'Mic tanpa kabel', 'stock' => 6, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 4, 'name' => 'Stand Speaker', 'description' => 'Tripod speaker', 'stock' => 5, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],

            ['category_id' => 5, 'name' => 'Proyektor', 'description' => 'Proyektor HD', 'stock' => 3, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 5, 'name' => 'Layar Proyektor', 'description' => 'Screen proyektor', 'stock' => 3, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 5, 'name' => 'Kamera DSLR', 'description' => 'Kamera foto & video', 'stock' => 2, 'status' => 'unavailable', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 5, 'name' => 'Tripod Kamera', 'description' => 'Tripod aluminium', 'stock' => 5, 'status' => 'available', 'image' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
