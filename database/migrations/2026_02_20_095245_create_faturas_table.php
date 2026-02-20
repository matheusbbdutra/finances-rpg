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
        Schema::create("faturas", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("cartao_id")->constrained("cartaos");
            $table->string("mes_referencia");
            $table->decimal("valor_fechamento", 15, 2)->default(0);
            $table->decimal("valor_vencimento", 15, 2)->default(0);
            $table->decimal("valor_pago", 15, 2)->default(0);
            $table->date("data_fechamento")->nullable();
            $table->date("data_vencimento")->nullable();
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
        Schema::dropIfExists("faturas");
    }
};
