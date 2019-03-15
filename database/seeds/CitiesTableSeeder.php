<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name' => 'Cologne',
            'code' => 'COL',
        ]);

        DB::table('cities')->insert([
            'name' => 'Berlin',
            'code' => 'BER',
        ]);
    }
}
