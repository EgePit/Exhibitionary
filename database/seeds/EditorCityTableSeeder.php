<?php

use Illuminate\Database\Seeder;

class EditorCityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('editor_city')->insert([
            'editor_id' => 1,
            'city_id' => 1,
        ]);

        DB::table('editor_city')->insert([
            'editor_id' => 1,
            'city_id' => 2,
        ]);

        DB::table('editor_city')->insert([
            'editor_id' => 2,
            'city_id' => 2,
        ]);

        DB::table('editor_city')->insert([
            'editor_id' => 3,
            'city_id' => 1,
        ]);

        DB::table('editor_city')->insert([
            'editor_id' => 4,
            'city_id' => 1,
        ]);
    }
}
