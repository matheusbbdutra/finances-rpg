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
        Schema::create("transacao_tag", function (Blueprint $table) {
            $table->id();
            $table->foreignId("transacao_id")->constrained("transacaos");
            $table->foreignId("tag_id")->constrained("tags");
            $table->timestamps();
            $table->unique(["transacao_id", "tag_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("transacao_tag");
    }
};
