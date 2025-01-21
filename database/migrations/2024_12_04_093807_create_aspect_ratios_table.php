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
        Schema::create('aspect_ratios', function (Blueprint $table) {
            $table->id();
			$table->string('aspect_ratio');     // Que aspect_ratio mostrar en la creación de la imagen
			$table->string('width');     // Que width usar en la creación de la imagen
			$table->string('height');     // Que height usar en la creación de la imagen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspect_ratios');
    }
};
