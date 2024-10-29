<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'jan' => '22000019',
                'name' => '遠藤翔',
                'name_kana' => 'エンドウショウ',
                'birth_date' => '1990-01-01',
                'phone_number' => '090-0000-0000',
                'email' => 'test1@test.com',
                'password' => Hash::make('test1234'),
            ],
            [
                'jan' => '22000026',
                'name' => '佐々木明子',
                'name_kana' => 'ササキアキコ',
                'birth_date' => '1980-01-01',
                'phone_number' => '090-0000-0000',
                'email' => 'test2@test.com',
                'password' => Hash::make('test1234'),
            ],
            [
                'jan' => '22000033',
                'name' => '金谷光雄',
                'name_kana' => 'カナヤミツオ',
                'birth_date' => '1960-01-01',
                'phone_number' => '03-0000-0000',
                'email' => null,
                'password' => null,
            ],
        ]);
    }
}
