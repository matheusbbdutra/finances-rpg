<?php

namespace App\Domain\Investiment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investimento extends Model
{
    protected $fillable = [
        "user_id",
        "conta_id",
        "nome",
        "tipo",
        "valor_investido",
        "valor_atual",
        "taxa_retorno",
        "data_inicio",
        "data_vencimento",
        "liquidez",
        "ativo",
    ];

    protected $casts = [
        "valor_investido" => "decimal:2",
        "valor_atual" => "decimal:2",
        "taxa_retorno" => "decimal:4",
        "data_inicio" => "date",
        "data_vencimento" => "date",
        "ativo" => "boolean",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Auth\Models\User::class);
    }

    public function conta(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Finance\Models\Conta::class);
    }

    public function posicoes(): HasMany
    {
        return $this->hasMany(Posicao::class);
    }
}
