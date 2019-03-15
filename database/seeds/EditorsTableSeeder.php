<?php

use Illuminate\Database\Seeder;

class EditorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('editors')->insert([
            'name' => 'Editor',
            'description' => 'I\'m Super editor',
        ]);

        DB::table('editors')->insert([
            'name' => 'Editor 2',
            'description' => 'I\'m Super editor2',
        ]);

        DB::table('editors')->insert([
            'name' => 'Editor 3',
            'description' => 'I\'m Super editor3',
        ]);

        DB::table('editors')->insert([
            'name' => 'Editor 4',
            'description' => 'I\'m Super editor4',
        ]);
    }
}
