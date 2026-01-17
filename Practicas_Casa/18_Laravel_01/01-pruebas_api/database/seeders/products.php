<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class products extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //["nombre", "descripcion", "precio", "foto"];
        DB::table('products')->insert([
            [
                'nombre' => 'Camiseta Deportiva',
                'descripcion' => 'Camiseta de algodón para deporte',
                'precio' => 25.99,
                'foto' => null
            ],
            [
                'nombre' => 'Laptop Gamer',
                'descripcion' => 'Laptop con tarjeta gráfica RTX 4070',
                'precio' => 1999.99,
                'foto' => null
            ],
            [
                'nombre' => 'Auriculares',
                'descripcion' => 'Bluetooth con cancelación de ruido',
                'precio' => 89.50,
                'foto' => null
            ],
            [
                'nombre' => 'Mochila Escolar',
                'descripcion' => 'Mochila resistente para laptop',
                'precio' => 45.00,
                'foto' => null
            ],
            [
                'nombre' => 'Smartwatch',
                'descripcion' => 'Reloj inteligente con monitor de salud',
                'precio' => 129.99,
                'foto' => null
            ]
        ]);
        

    }
}
