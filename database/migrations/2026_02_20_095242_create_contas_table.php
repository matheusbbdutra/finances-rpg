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
        Schema::create("contas", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("nome");
            $table->string("tipo");
            $table->decimal("saldo_inicial", 15, 2)->default(0);
            $table->decimal("saldo_atual", 15, 2)->default(0);
            $table->string("cor")->nullable();
            $table->string("icone")->nullable();
            $table->string("instituicao")->nullable();
            $table->boolean("ativo")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("contas");
    }
};
