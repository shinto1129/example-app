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
            'name' => '椅子',
            'stock' => '7',
        ]);
        \DB::table('items')->insert([
            'name' => '机',
            'stock' => '1',
        ]);
        \DB::table('items')->insert([
            'name' => 'マイク',
            'stock' => '3',
        ]);
        \DB::table('items')->insert([
            'name' => 'プロジェクター',
            'stock' => '1',
        ]);
        \DB::table('items')->insert([
            'name' => 'ホワイトボード',
            'stock' => '2',
        ]);
        \DB::table('items')->insert([
            'name' => 'スピーカー',
            'stock' => '1',
        ]);
    }
}
