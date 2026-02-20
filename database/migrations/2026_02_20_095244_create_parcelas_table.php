<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("parcelas", function (Blueprint $table) {
            $table->id();
            $table->foreignId("transacao_id")->constrained("transacaos");
            $table->integer("numero_parcela");
            $table->decimal("valor", 15, 2);
            $table->date("data_vencimento");
            $table->date("data_pagamento")->nullable();
            $table->string("status")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("parcelas");
    }
};
