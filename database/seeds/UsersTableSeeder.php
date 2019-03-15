<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'email' => 'admin@mail.com',
            'newsletters_subs' => false,
            'is_admin' => true,
            'whois' => 'admin',
            'password' => bcrypt('123456'),
        ]);

        DB::table('users')->insert([
            'firstname' => 'New',
            'lastname' => 'User',
            'email' => 'new.user@mail.com',
            'newsletters_subs' => true,
            'is_admin' => false,
            'whois' => 'user',
            'password' => bcrypt('123456'),
        ]);
    }
}
