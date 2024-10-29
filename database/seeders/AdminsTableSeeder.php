<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'name' => 'testAdmin1',
                'jan' => '20000011',
                'password' => Hash::make('test1234'),
                'role_id' => 1,
            ],
            [
                'name' => 'testAdmin2',
                'jan' => '20000028',
                'password' => Hash::make('test1234'),
                'role_id' => 1,
            ],
            [
                'name' => 'testAdmin3',
                'jan' => '20000035',
                'password' => Hash::make('test1234'),
                'role_id' => 2,
            ],
        ]);
    }
}
