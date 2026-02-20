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
        Schema::create('investimentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('conta_id')->nullable()->constrained('contas')->nullOnDelete();
            $table->string('nome');
            $table->string('tipo')->nullable();
            $table->decimal('valor_investido', 10, 2)->default(0);
            $table->decimal('valor_atual', 10, 2)->default(0);
            $table->decimal('taxa_retorno', 10, 4)->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_vencimento')->nullable();
            $table->string('liquidez')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investimentos');
    }
};
