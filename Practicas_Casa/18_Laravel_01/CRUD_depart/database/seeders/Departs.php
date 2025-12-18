<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Departs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("
            INSERT INTO departs2 (depart_no, dnombre, loc, created_at, updated_at) VALUES 
                (10,'CONTABILIDAD','SEVILLA', NOW(), NOW()),
                (20,'INVESTIGACIÓN','MADRID', NOW(), NOW()),
                (30,'VENTAS','BARCELONA',  NOW(), NOW()),
                (40,'PRODUCCIÓN','BILBAO',  NOW(), NOW());
        ");
    }
}
