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
        Schema::create('loras', function (Blueprint $table) {
            $table->id();
			$table->string('lora');     // Que lora usar en la creación de la imagen
			$table->string('url_img_lora');     // Que url usar para mostrar img de cada lora
			$table->string('infoLoraIni')->nullable();  // Para generar imagen si es tipo lora
			$table->string('infoLoraEnd')->nullable();  // Para generar imagen si es tipo lora
			$table->string('description')->nullable();     // Que description usar para cada lora
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loras');
    }
};
