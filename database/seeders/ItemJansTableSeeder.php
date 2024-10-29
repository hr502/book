<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemJansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('item_jans')->insert([
            [
                'item_id' => '1',
                'jan' => '2091380001013',
                'status_id' => '1',
            ],
            [
                'item_id' => '1',
                'jan' => '2091380001020',
                'status_id' => '2',
            ],
            [
                'item_id' => '1',
                'jan' => '2091380001037',
                'status_id' => '3',
            ],
            [
                'item_id' => '2',
                'jan' => '2091380002010',
                'status_id' => '1',
            ],
            [
                'item_id' => '2',
                'jan' => '2091380002027',
                'status_id' => '3',
            ],
        ]);
    }
}
