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
        Schema::create('guidance_scales', function (Blueprint $table) {
            $table->id();
			$table->integer('min');     // Que guidance_scale min usar en la creación de la imagen
			$table->integer('max');     // Que guidance_scale max usar en la creación de la imagen
			$table->integer('default');     // Que guidance_scale default usar en la creación de la imagen
			$table->string('description')->nullable();     // Que description usar para cada guidance_scale
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guidance_scales');
    }
};
