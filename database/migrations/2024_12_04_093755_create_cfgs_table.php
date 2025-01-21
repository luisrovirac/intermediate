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
        Schema::create('cfgs', function (Blueprint $table) {
            $table->id();
			$table->integer('min');     // Que cfg min usar en la creación de la imagen
			$table->integer('max');     // Que cfg max usar en la creación de la imagen
			$table->integer('default');     // Que cfg default usar en la creación de la imagen
			$table->string('description')->nullable();     // Que description usar para cfg
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cfgs');
    }
};
