<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            [
                'code' => 'BK',
                'name' => '図書',
                'category_id' => '1'
            ],
            [
                'code' => 'PE',
                'name' => '文庫',
                'category_id' => '1'
            ],
            [
                'code' => 'PB',
                'name' => '新書',
                'category_id' => '1'
            ],
            [
                'code' => 'PI',
                'name' => '絵本',
                'category_id' => '1'
            ],
            [
                'code' => 'CM',
                'name' => 'コミック',
                'category_id' => '1'
            ],
            [
                'code' => 'PS',
                'name' => '紙芝居',
                'category_id' => '1'
            ],
            [
                'code' => 'PM',
                'name' => 'その他印刷物',
                'category_id' => '1'
            ],
            [
                'code' => 'MG',
                'name' => '雑誌',
                'category_id' => '2'
            ],
            [
                'code' => 'CD',
                'name' => 'CD',
                'category_id' => '3'
            ],
            [
                'code' => 'DV',
                'name' => 'DVD',
                'category_id' => '3'
            ],


        ]);
    }
}
