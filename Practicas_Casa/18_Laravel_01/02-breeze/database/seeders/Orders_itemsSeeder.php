<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Orders_itemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders_products')->insert([
            "order_id" => 1,
            "product_id" => 1,
            "quantity" => 1,
        ]);

        DB::table('orders_products')->insert([
            "order_id" => 1,
            "product_id" => 1,
            "quantity" => 1,
        ]);
    }
}
