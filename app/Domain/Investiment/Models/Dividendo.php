<?php

namespace App\Domain\Investiment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dividendo extends Model
{
    protected $fillable = [
        "user_id",
        "ativo_id",
        "posicao_id",
        "tipo",
        "valor",
        "data_pagamento",
        "data_com",
        "quantidade",
        "preco_unitario",
    ];

    protected $casts = [
        "valor" => "decimal:2",
        "data_pagamento" => "date",
        "data_com" => "date",
        "quantidade" => "integer",
        "preco_unitario" => "decimal:4",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Auth\Models\User::class);
    }

    public function ativo(): BelongsTo
    {
        return $this->belongsTo(Ativo::class);
    }

    public function posicao(): BelongsTo
    {
        return $this->belongsTo(Posicao::class);
    }
}
