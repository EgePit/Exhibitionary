<?php

use Illuminate\Database\Seeder;

class InstitutionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutions')->insert([
            'name' => 'COL Gallery',
            'address' => 'Green street 65',
            'hours' => 'Mon.-Fri.: 09:00-18:00',
            'website' => 'http://my.gallery.com',
            'phone' => '+1 111 111 1111',
            'email' => 'my.gallery@mail.com',
            'type_id' => 1,
            'city_id' => 1,
        ]);

        DB::table('institutions')->insert([
            'name' => 'COL Museum',
            'address' => 'Green street 65',
            'hours' => 'Mon.-Fri.: 09:00-18:00',
            'website' => 'http://my.museum.com',
            'phone' => '+1 111 111 1111',
            'email' => 'my.museum@mail.com',
            'type_id' => 2,
            'city_id' => 1,
        ]);

        DB::table('institutions')->insert([
            'name' => 'BER Gallery',
            'address' => 'Green street 65',
            'hours' => 'Mon.-Fri.: 09:00-18:00',
            'website' => 'http://my.gallery.com',
            'phone' => '+1 111 111 1111',
            'email' => 'my.gallery@mail.com',
            'type_id' => 1,
            'city_id' => 2,
        ]);

        DB::table('institutions')->insert([
            'name' => 'BER Museum',
            'address' => 'Green street 65',
            'hours' => 'Mon.-Fri.: 09:00-18:00',
            'website' => 'http://my.museum.com',
            'phone' => '+1 111 111 1111',
            'email' => 'my.museum@mail.com',
            'type_id' => 2,
            'city_id' => 2,
        ]);
    }
}
