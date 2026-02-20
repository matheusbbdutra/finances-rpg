<?php

namespace App\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cartao extends Model
{
    protected $fillable = [
        "user_id",
        "nome",
        "limite_total",
        "limite_utilizado",
        "dia_fechamento",
        "dia_vencimento",
        "conta_vinculada_id",
        "bandeira",
        "ativo",
    ];

    protected $casts = [
        "limite_total" => "decimal:2",
        "limite_utilizado" => "decimal:2",
        "dia_fechamento" => "integer",
        "dia_vencimento" => "integer",
        "ativo" => "boolean",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Auth\Models\User::class);
    }

    public function contaVinculada(): BelongsTo
    {
        return $this->belongsTo(Conta::class, "conta_vinculada_id");
    }

    public function transacoes(): HasMany
    {
        return $this->hasMany(Transacao::class);
    }

    public function faturas(): HasMany
    {
        return $this->hasMany(Fatura::class);
    }
}
