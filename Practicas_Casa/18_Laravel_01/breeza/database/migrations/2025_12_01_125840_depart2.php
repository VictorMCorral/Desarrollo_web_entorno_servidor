<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("departs2", function(Blueprint $table) {
            $table->integer("depart_no")->primary();
            $table->string("dnombre");
            $table->string("loc");
            $table->timestamps();
        });

        Schema::create("departs_manual", function(Blueprint $table){
            $table->integer("departs_no")->primary();
            $table->string("dnombre");
            $table->string("loc");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
