<?php

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('districts')->insert([
            'name' => 'West COL',
            'city_id' => 1,
        ]);

        DB::table('districts')->insert([
            'name' => 'East COL',
            'city_id' => 1,
        ]);

        DB::table('districts')->insert([
            'name' => 'South COL',
            'city_id' => 1,
        ]);

        DB::table('districts')->insert([
            'name' => 'North COL',
            'city_id' => 1,
        ]);

        DB::table('districts')->insert([
            'name' => 'Center BER',
            'city_id' => 1,
        ]);

        DB::table('districts')->insert([
            'name' => 'West BER',
            'city_id' => 2,
        ]);

        DB::table('districts')->insert([
            'name' => 'East BER',
            'city_id' => 2,
        ]);

        DB::table('districts')->insert([
            'name' => 'South BER',
            'city_id' => 2,
        ]);

        DB::table('districts')->insert([
            'name' => 'North BER',
            'city_id' => 2,
        ]);

        DB::table('districts')->insert([
            'name' => 'Center BER',
            'city_id' => 2,
        ]);
    }
}
