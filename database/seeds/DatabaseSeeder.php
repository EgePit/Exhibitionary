<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(DistrictsTableSeeder::class);
        $this->call(InstitutionTypesTableSeeder::class);
        $this->call(InstitutionsTableSeeder::class);
        $this->call(EditorsTableSeeder::class);
        $this->call(EditorCityTableSeeder::class);
        $this->call(DistrictExhibitionTableSeeder::class);
        $this->call(EditorExhibitionTableSeeder::class);
        $this->call(ExhibitionCityTableSeeder::class);
        $this->call(ExhibitionsTableSeeder::class);
    }
}
