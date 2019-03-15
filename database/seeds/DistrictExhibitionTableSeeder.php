<?php

use Illuminate\Database\Seeder;

class DistrictExhibitionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('district_exhibition')->insert([
            'district_id' => 3,
            'exhibition_id' => 1,
        ]);
    }
}
