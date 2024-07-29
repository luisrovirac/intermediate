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
        Schema::create('configmsgs', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
				  $table->String("arraymessage");         // string separado por comas con id de los msgs
				  $table->Integer("forporcentaje");      // 2   - 80%
				  $table->Integer("waittimeinseconds");  // 600 - 10 minutos
				  $table->Integer("minNumberRandom");    // Número inicial para el random a solicitar (ej desde 1)
				  $table->Integer("maxNumberRandom");    // Número final para el random a solicitar (ej desde 10)
    	});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configmsgs');
    }
};
