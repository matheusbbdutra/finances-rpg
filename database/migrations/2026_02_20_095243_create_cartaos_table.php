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
        Schema::create("cartaos", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users");
            $table->string("nome");
            $table->decimal("limite_total", 15, 2)->default(0);
            $table->decimal("limite_utilizado", 15, 2)->default(0);
            $table->integer("dia_fechamento");
            $table->integer("dia_vencimento");
            $table->foreignId("conta_vinculada_id")->nullable()->constrained("contas");
            $table->string("bandeira")->nullable();
            $table->boolean("ativo")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("cartaos");
    }
};
