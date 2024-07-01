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
        Schema::create('assistants', function (Blueprint $table) {
            $table->id();
            //$table->unsignedinteger('typesexes_id')->nullable();
			$table->bigInteger('typesex_id')->unsigned();
			$table->string('name');
			$table->string('infoLoraIni');
			$table->string('infoLoraEnd');
			$table->longtext('details');
			$table->timestamps();
            
            $table->foreign('typesex_id')->references('id')->on('typesexes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            /*$table->foreign('typesexes_id')->references('id')->on('typesexes')
                ->onDelete('set null')
                ->onUpdate('cascade');
*/
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistants');
    }
};
