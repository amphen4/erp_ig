<?php

use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('clientes')->insert([
            'nombre' => 'Alejandro Guillier',
            'email' => 'a@q.p',
            'rut' => '123wow-wow',
            'comuna' => 'Santiago',
            'direccion' => 'Avda. Wow #0',
            'region' => 'METROPOLITANA',
            'razon_social' => 'Wow S.A',
            'nro' => 11,
            'fono1' => '+569 77881492',
            'giro' => 'PARTICULAR'
        ]);
        DB::table('clientes')->insert([
            'nombre' => 'Sebastian Pinera',
            'email' => 'acm1@p.t',
            'rut' => '12345678-9',
            'comuna' => 'Limache',
            'direccion' => 'Choche #007',
            'region' => 'VALPARAISO',
            'razon_social' => 'Lorax Alta Gama',
            'nro' => 13,
            'fono1' => '+569 77881492',
            'giro' => 'PARTICULAR'
        ]);
        
    }
}
