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
        Schema::create("orcamentos", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("categoria_id")->constrained("categorias");
            $table->string("nome");
            $table->decimal("valor_limite", 15, 2);
            $table->decimal("valor_gasto", 15, 2)->default(0);
            $table->integer("ano");
            $table->integer("mes");
            $table->boolean("ativo")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("orcamentos");
    }
};
