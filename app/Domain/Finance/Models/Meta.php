<?php

namespace App\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meta extends Model
{
    protected $fillable = [
        "user_id",
        "nome",
        "descricao",
        "valor_alvo",
        "valor_atual",
        "data_inicio",
        "data_meta",
        "data_conclusao",
        "status",
        "ativo",
    ];

    protected $casts = [
        "valor_alvo" => "decimal:2",
        "valor_atual" => "decimal:2",
        "data_inicio" => "date",
        "data_meta" => "date",
        "data_conclusao" => "date",
        "ativo" => "boolean",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Auth\Models\User::class);
    }
}
