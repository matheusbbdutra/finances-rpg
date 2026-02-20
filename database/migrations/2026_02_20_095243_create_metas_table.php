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
        Schema::create("metas", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("nome");
            $table->text("descricao")->nullable();
            $table->decimal("valor_alvo", 15, 2);
            $table->decimal("valor_atual", 15, 2)->default(0);
            $table->date("data_inicio")->nullable();
            $table->date("data_meta")->nullable();
            $table->date("data_conclusao")->nullable();
            $table->string("status")->nullable();
            $table->boolean("ativo")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("metas");
    }
};
