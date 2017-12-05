<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(MarcasTableSeeder::class);
        $this->call(SucursalsTableSeeder::class);
        $this->call(AdminusersTableSeeder::class);
        
        $this->call(InventariosTableSeeder::class);
        
        $this->call(CategoriasTableSeeder::class);
        $this->call(ProductosTableSeeder::class);

        $this->call(OtestadosTableSeeder::class);

        $this->call(VentasuserTableSeeder::class);

        $this->call(ClientesTableSeeder::class);

        $this->call(FacturacionusersTableSeeder::class);
        $this->call(ProduccionusersTableSeeder::class);
        $this->call(RootsTableSeeder::class);
    }
}
