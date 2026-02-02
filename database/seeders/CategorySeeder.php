<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Alat Pertukangan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alat Konstruksi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alat Listrik', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sound System', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Multimedia', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
