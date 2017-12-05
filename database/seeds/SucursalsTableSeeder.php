<?php

use Illuminate\Database\Seeder;

class SucursalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sucursals')->insert([
            'id' => 1,
            'nombre' => 'Sucursal Test',
            'direccion' => 'Avda. Alameda #666, Santiago, Chile',
        ]);

    }
}