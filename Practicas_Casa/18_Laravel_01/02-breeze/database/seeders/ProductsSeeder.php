<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            "name" => "Pollo",
            "description" => "Pollo asado",
            "price" => 12,
            "available" => true, 
            "product_type" => "plato",
            "image" => null,
            "date" => now()->toDateString(),
            "pick_up" => "Recoger en local", 
        ]);

        DB::table('products')->insert([
            "name" => "Menu 2",
            "description" => "Menu 2",
            "price" => 8,
            "available" => true, 
            "product_type" => "menu",
            "image" => null,
            "date" => now()->toDateString(),
            "pick_up" => "Recoger en local", 
        ]);

        DB::table('products')->insert([
            "name" => "Menu 11",
            "description" => "Menu 11",
            "price" => 8,
            "available" => true, 
            "product_type" => "menu",
            "image" => null,
            "date" => now()->toDateString(),
            "pick_up" => "Recoger en local", 
        ]);

        DB::table('products')->insert([
            "name" => "Menu 25",
            "description" => "Menu 25",
            "price" => 8,
            "available" => true, 
            "product_type" => "menu",
            "image" => null,
            "date" => now()->toDateString(),
            "pick_up" => "Recoger en local", 
        ]);
        
    }
}
