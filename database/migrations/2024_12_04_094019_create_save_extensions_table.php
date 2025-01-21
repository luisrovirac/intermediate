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
        Schema::create('save_extensions', function (Blueprint $table) {
            $table->id();
			$table->string('save_extension');     // Que save_extension usar al salvar la imagen
			$table->boolean('default');     // Que save_extension usar por default
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('save_extensions');
    }
};
