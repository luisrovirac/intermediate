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
        Schema::create('negative_prompts', function (Blueprint $table) {
            $table->id();
			$table->string('default_negative_prompt');     // Que negative_prompt default para usar en la creación de la imagen
			$table->string('description')->nullable();     // Que description usar para negative_prompt
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('negative_prompts');
    }
};
