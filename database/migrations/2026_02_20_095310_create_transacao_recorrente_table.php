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
        Schema::create('transacao_recorrente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recorrencia_id')->constrained('recorrencias')->cascadeOnDelete();
            $table->foreignId('transacao_id')->nullable()->constrained('transacaos')->nullOnDelete();
            $table->date('data_gerada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacao_recorrente');
    }
};
