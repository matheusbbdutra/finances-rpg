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
        Schema::create("transacaos", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("conta_id")->constrained("contas");
            $table->foreignId("cartao_id")->nullable()->constrained("cartaos");
            $table->foreignId("categoria_id")->nullable()->constrained("categorias");
            $table->string("tipo");
            $table->string("descricao")->nullable();
            $table->decimal("valor", 15, 2);
            $table->date("data_transacao");
            $table->date("data_efetivacao")->nullable();
            $table->string("status")->nullable();
            $table->integer("parcelas")->nullable();
            $table->foreignId("conta_destino_id")->nullable()->constrained("contas");
            $table->foreignId("transacao_origem_id")->nullable()->constrained("transacaos");
            $table->text("observacoes")->nullable();
            $table->string("localizacao")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("transacaos");
    }
};
