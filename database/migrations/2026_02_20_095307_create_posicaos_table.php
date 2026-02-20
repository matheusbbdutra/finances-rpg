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
        Schema::create('posicaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('investimento_id')->constrained('investimentos')->cascadeOnDelete();
            $table->foreignId('ativo_id')->nullable()->constrained('ativos')->nullOnDelete();
            $table->integer('quantidade')->default(0);
            $table->decimal('preco_medio', 10, 4)->default(0);
            $table->decimal('valor_atual', 10, 2)->default(0);
            $table->decimal('variacao', 10, 4)->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posicaos');
    }
};
