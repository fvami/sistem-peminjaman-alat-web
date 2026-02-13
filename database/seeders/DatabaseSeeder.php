<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\ToolSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call([
        //     CategorySeeder::class,
        //     ToolSeeder::class,
        // ]);


        Role::insert([
            ['name' => 'Operator', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Administrator', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
