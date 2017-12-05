<?php

use Illuminate\Database\Seeder;

class AdminusersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('adminusers')->insert([
            'name' => 'Root Daniel Gajardo',
            'email' => 'wary@tforce.cl',
            'tipo' => 'all',
            'password' => bcrypt('prueba'),
        ]);
        DB::table('adminusers')->insert([
            'name' => 'Desarrollador',
            'email' => 'alexandrox4@gmail.com',
            'tipo' => 'all',
            'password' => bcrypt('prueba'),
        ]);

    }
}
