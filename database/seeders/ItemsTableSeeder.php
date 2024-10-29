<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'title' => '新編 銀河鉄道の夜',
                'author' => '宮沢賢治',
                'publisher' => '新潮社',
                'series' => '新潮文庫',
                'detail' => '銀河鉄道の夜 / 宮沢賢治',
                'published_on' => '1992.11',
                'classification' => '913.8',
                'code' => '9784101092052',
                'price' => 360,
                'type_code' => 'PE',
                'file_name' => '109205_xl.jpg',
                'file_path' => 'storage/item_img/109205_xl.jpg',
            ],
            [
                'title' => 'ねないこ だれだ',
                'author' => 'せなけいこ',
                'publisher' => '福音館書店',
                'series' => '',
                'detail' => 'こんな時間におきてるのだれだ？　ふくろうにどらねこにどろぼう……。そうら、もうおばけの時間なのに――。',
                'published_on' => '1969.11',
                'classification' => '913.8',
                'code' => '9784834002188',
                'price' => 770,
                'type_code' => 'PI',
                'file_name' => '01-0218_01.jpg',
                'file_path' => 'storage/item_img/01-0218_01.jpg',
            ],
        ]);
    }
}
