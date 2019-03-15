<?php

use Illuminate\Database\Seeder;

class InstitutionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institution_types')->insert([
            'name' => 'Gallery',
        ]);

        DB::table('institution_types')->insert([
            'name' => 'Museum',
        ]);
    }
}
