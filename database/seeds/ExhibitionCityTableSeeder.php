<?php

use Illuminate\Database\Seeder;

class ExhibitionCityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exhibition_city')->insert([
            'exhibition_id' => 1,
            'city_id' => 1,
        ]);
    }
}
