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
        Schema::create('image_numbers', function (Blueprint $table) {
            $table->id();
			$table->integer('default_image_numbers');     // Que default image_number usar como deafault en la creación de la imagen
			$table->string('description')->nullable();     // Que description usar para el image_number
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_numbers');
    }
};
