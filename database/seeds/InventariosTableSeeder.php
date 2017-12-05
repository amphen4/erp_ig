<?php

use Illuminate\Database\Seeder;

class InventariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventarios')->insert([
            'id' => 1,
            'nombre' => 'Inventario 2017 Test',
            'sucursal_id' => 1,
        ]);

    }
}