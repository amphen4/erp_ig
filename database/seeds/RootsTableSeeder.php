<?php

use Illuminate\Database\Seeder;

class RootsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roots')->insert([
            'name' => 'God Emperor Kast',
            'email' => 'alexandrox4@gmail.com',
            'password' => bcrypt('pruebaroot'),
        ]);
    }
}
