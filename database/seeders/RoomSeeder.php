<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i<=7; $i++){
            \DB::table('rooms')->insert([
                'name' => '教室'.$i
            ]);
        }

    }
}
