<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            [
                'id' => '1',
                'name' => '貸出可',
            ],
            [
                'id' => '2',
                'name' => '取置中',
            ],
            [
                'id' => '3',
                'name' => '貸出中',
            ],
            [
                'id' => '9',
                'name' =>  '禁退出',
            ]
        ]);
    }
}
