<?php

use Illuminate\Database\Seeder;

class OtestadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('otestados')->insert([
            'id' => 1,
            'nombre' => 'PENDIENTE'
        ]);
        DB::table('otestados')->insert([
            'id' => 2,
            'nombre' => 'EN PROCESO'
        ]);
        DB::table('otestados')->insert([
            'id' => 3,
            'nombre' => 'EN COTIZACION'
        ]);
        DB::table('otestados')->insert([
            'id' => 4,
            'nombre' => 'ACTIVA'
        ]);
        DB::table('otestados')->insert([
            'id' => 5,
            'nombre' => 'PERDIDA'
        ]);
        DB::table('otestados')->insert([
            'id' => 6,
            'nombre' => 'POR FACTURAR'
        ]);
        DB::table('otestados')->insert([
            'id' => 7,
            'nombre' => 'FACTURADO'
        ]);
        DB::table('otestados')->insert([
            'id' => 8,
            'nombre' => 'NOTA DE VENTA'
        ]);
    }
}
