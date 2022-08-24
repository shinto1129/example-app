<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => '管理者',
            'email' => 'test0@test.com',
            'password' => \Hash::make('hasiguti'),
            'adress' => '愛知県名古屋市中区',
            'tel' => '09012345678',
        ]);
        \DB::table('users')->insert([
            'name' => '橋口信人',
            'email' => 'test1@test.com',
            'password' => \Hash::make('hasiguti'),
            'adress' => '愛知県名古屋市緑区',
            'tel' => '08012348765',
        ]);
        \DB::table('users')->insert([
            'name' => '橋口',
            'email' => 'test2@test.com',
            'password' => \Hash::make('hasiguti'),
            'adress' => '愛知県名古屋市',
            'tel' => '08012348765',
        ]);
        \DB::table('users')->insert([
            'name' => 'テスト１',
            'email' => 'test3@test.com',
            'password' => \Hash::make('hasiguti'),
            'adress' => '愛知県半田市',
            'tel' => '08012348765',
        ]);
        \DB::table('users')->insert([
            'name' => 'テスト２',
            'email' => 'test4@test.com',
            'password' => \Hash::make('hasiguti'),
            'adress' => '愛知県半田市',
            'tel' => '08012348765',
        ]);
        \DB::table('users')->insert([
            'name' => 'テスト３',
            'email' => 'test5@test.com',
            'password' => \Hash::make('hasiguti'),
            'adress' => '愛知県半田市',
            'tel' => '08012348765',
        ]);
        \DB::table('users')->insert([
            'name' => 'テスト４',
            'email' => 'test6@test.com',
            'password' => \Hash::make('hasiguti'),
            'adress' => '愛知県半田市',
            'tel' => '08012348765',
        ]);
    }
}
