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
        Schema::create("emples", function(Blueprint $table) {
            $table->timestamps();
            $table->integer("emple_no")->primary();
            $table->string("apellido");
            $table->string("oficio");
            $table->integer("dir")->nullable();
            $table->date("fecha_alt");
            $table->double("salario");
            $table->double("comision")->nullable();
            $table->integer("depart_no");
            
            $table->foreign('depart_no')->references('depart_no')->on('departs2');
            $table->foreign('dir')->references('emple_no')->on('emples');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
