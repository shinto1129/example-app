<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('items')->insert([
            'name' => '椅子'
        ]);
        \DB::table('items')->insert([
            'name' => '机'
        ]);
        \DB::table('items')->insert([
            'name' => 'マイク'
        ]);
        \DB::table('items')->insert([
            'name' => 'プロジェクター'
        ]);
        \DB::table('items')->insert([
            'name' => 'ホワイトボード'
        ]);
        \DB::table('items')->insert([
            'name' => 'スピーカー'
        ]);
    }
}
