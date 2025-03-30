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
        Schema::create('usuaris', function (Blueprint $table) {
            $table->id('ID');
            $table->string('nombreUsuario', 50)->unique();
            $table->string('contrasenya', 255);
            $table->string('correo', 100)->unique();
            $table->string('ciutat', 100);
            $table->string('imatge', 1024)->nullable();
            $table->string('token', 255)->nullable();
            $table->dateTime('expiracio_token')->nullable();
            $table->string('remember_token', 255)->nullable();
            $table->dateTime('remember_token_expiracio')->nullable();
            $table->timestamps();//
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuaris');
    }
};
