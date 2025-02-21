<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Status;
use Illuminate\Database\Seeder;

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

        $this->call([
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            AdminsTableSeeder::class,
            CategoriesTableSeeder::class,
            TypesTableSeeder::class,
            ItemsTableSeeder::class,
            StatusesTableSeeder::class,
            ItemJansTableSeeder::class,
        ]);
    }
}
