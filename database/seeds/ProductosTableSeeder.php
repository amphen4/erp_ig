<?php

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'id' => 1,
            'nombre' => 'Notebook Dell XPS 15',
            'stock' => 10,
            'precio_venta' => 107100,
            'precio_neto' => 90000,
            'precio_iva' => 17100,
            'codigo' => 123,
            'categoria_id' => 1,
            'inventario_id' => 1,
            'marca_id' => 1,
        ]);
        DB::table('productos')->insert([
            'id' => 2,
            'nombre' => 'Apple iPhone X',
            'stock' => 15,
            'precio_venta' => 1190,
            'precio_neto' => 1000,
            'precio_iva' => 190,
            'codigo' => 456,
            'categoria_id' => 1,
            'inventario_id' => 1,
            'marca_id' => 1,
        ]);
        DB::table('productos')->insert([
            'id' => 3,
            'nombre' => 'Sony Playstation 4 Pro',
            'stock' => 19,
            'precio_venta' => 11900,
            'precio_neto' => 10000,
            'precio_iva' => 1900,
            'codigo' => 456,
            'categoria_id' => 1,
            'inventario_id' => 1,
            'marca_id' => 1,
        ]);
    }
}