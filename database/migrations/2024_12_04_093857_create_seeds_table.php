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
        Schema::create('seeds', function (Blueprint $table) {
            $table->id();
			$table->string('default_seed');     // Que seed usar como deafault en la creación de la imagen
			$table->string('description')->nullable();     // Que description usar para el seed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seeds');
    }
};
