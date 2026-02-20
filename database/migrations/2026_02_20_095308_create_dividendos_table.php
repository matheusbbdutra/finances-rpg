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
        Schema::create('dividendos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ativo_id')->nullable()->constrained('ativos')->nullOnDelete();
            $table->foreignId('posicao_id')->nullable()->constrained('posicaos')->nullOnDelete();
            $table->string('tipo')->nullable();
            $table->decimal('valor', 10, 2)->default(0);
            $table->date('data_pagamento')->nullable();
            $table->date('data_com')->nullable();
            $table->integer('quantidade')->default(0);
            $table->decimal('preco_unitario', 10, 4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dividendos');
    }
};
