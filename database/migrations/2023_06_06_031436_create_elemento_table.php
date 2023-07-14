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
        Schema::create('elemento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('text');
            $table->text('url');
            $table->text('descripcion');
            $table->unsignedBigInteger('cuento_id');
            $table->foreign('cuento_id')->references('id')->on('cuento');
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elemento');
    }
};
