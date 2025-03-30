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
        Schema::create('article', function (Blueprint $table) {
            $table->id('ID');
            $table->string('marca', 100);
            $table->string('model', 100);
            $table->integer('any');
            $table->string('color', 50);
            $table->string('matricula', 20);
            $table->string('nom_usuari', 50)->nullable();
            $table->string('imatge', 1024)->nullable();

            
            $table->foreign('nom_usuari')
                  ->references('nombreUsuario')
                  ->on('usuaris')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article');
    }
};
