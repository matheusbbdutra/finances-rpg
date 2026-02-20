<?php

namespace App\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Parcela extends Model
{
    protected $fillable = ["transacao_id", "numero_parcela", "valor", "data_vencimento", "data_pagamento", "status"];

    protected $casts = [
        "valor" => "decimal:2",
        "numero_parcela" => "integer",
        "data_vencimento" => "date",
        "data_pagamento" => "date",
    ];

    public function transacao(): BelongsTo
    {
        return $this->belongsTo(Transacao::class);
    }
}
