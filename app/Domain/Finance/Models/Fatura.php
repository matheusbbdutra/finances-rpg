<?php

namespace App\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fatura extends Model
{
    protected $fillable = [
        "user_id",
        "cartao_id",
        "mes_referencia",
        "valor_fechamento",
        "valor_vencimento",
        "valor_pago",
        "data_fechamento",
        "data_vencimento",
        "data_pagamento",
        "status",
    ];

    protected $casts = [
        "valor_fechamento" => "decimal:2",
        "valor_vencimento" => "decimal:2",
        "valor_pago" => "decimal:2",
        "data_fechamento" => "date",
        "data_vencimento" => "date",
        "data_pagamento" => "date",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Auth\Models\User::class);
    }

    public function cartao(): BelongsTo
    {
        return $this->belongsTo(Cartao::class);
    }

    public function transacoes(): HasMany
    {
        return $this->hasMany(Transacao::class);
    }
}
