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
			$table->bigInteger('typesex_id')->unsigned();  // sex type
			$table->string('name');
			$table->string('infoLoraIni')->nullable();  // Para generar imagen si es tipo lora
			$table->string('infoLoraEnd')->nullable();  // Para generar imagen si es tipo lora
			$table->string('voice');     // Que voz usar
			$table->longtext('details');  // Detalles que definen al asistente
			$table->string('photo01')->nullable();
			$table->string('photo02')->nullable();
			$table->string('photo03')->nullable();
			$table->string('photo04')->nullable();
			$table->string('photo05')->nullable();  
			$table->string('seed')->nullable();   // Para generar sus imágenes + campo prompt
			$table->string('typeSeed_o_Lora');    // Si usa lora o seed
			$table->longtext('prompt')->nullable();   // Para generar sus imágenes + campo seed
			$table->string('userIdCreator')->nullable();  // Que usuario lo creó
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
