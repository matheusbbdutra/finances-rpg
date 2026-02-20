<?php

namespace App\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conta extends Model
{
    protected $fillable = [
        "user_id",
        "nome",
        "tipo",
        "saldo_inicial",
        "saldo_atual",
        "cor",
        "icone",
        "instituicao",
        "ativo",
    ];

    protected $casts = [
        "saldo_inicial" => "decimal:2",
        "saldo_atual" => "decimal:2",
        "ativo" => "boolean",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Auth\Models\User::class);
    }

    public function transacoes(): HasMany
    {
        return $this->hasMany(Transacao::class);
    }

    public function investimentos(): HasMany
    {
        return $this->hasMany(\App\Domain\Investiment\Models\Investimento::class);
    }
}
