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
        Schema::create('ativos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nome');
            $table->string('tipo')->nullable();
            $table->decimal('preco_atual', 10, 4)->nullable();
            $table->decimal('variacao_dia', 10, 4)->nullable();
            $table->decimal('dividend_yield', 10, 4)->nullable();
            $table->decimal('p_l', 10, 2)->nullable();
            $table->timestamp('ultimo_update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ativos');
    }
};
