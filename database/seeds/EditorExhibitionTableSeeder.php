<?php

use Illuminate\Database\Seeder;

class EditorExhibitionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('editor_exhibition')->insert([
            'editor_id' => 3,
            'exhibition_id' => 1,
        ]);

        DB::table('editor_exhibition')->insert([
            'editor_id' => 4,
            'exhibition_id' => 1,
        ]);
    }
}
