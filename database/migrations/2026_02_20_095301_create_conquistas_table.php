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
        Schema::create('conquistas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nivel_id')->nullable()->constrained('nivels')->nullOnDelete();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->string('tipo')->nullable();
            $table->integer('meta')->nullable();
            $table->integer('recompensa_xp')->default(0);
            $table->integer('recompensa_moeda')->default(0);
            $table->string('icone')->nullable();
            $table->string('cor')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conquistas');
    }
};
