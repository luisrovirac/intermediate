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
        Schema::create('msgnotuseds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->string("stringId");
			$table->string("noUsedMessages");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('msgnotuseds');
    }
};
