<?php 

namespace App\Domain\Investiment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Posicao extends Model
{
    protected $fillable = [
        "user_id",
        "investimento_id",
        "ativo_id",
        "quantidade",
        "preco_medio",
        "valor_atual",
        "variacao",
        "ativo",
    ];

    protected $casts = [
        "quantidade" => "integer",
        "preco_medio" => "decimal:4",
        "valor_atual" => "decimal:2",
        "variacao" => "decimal:4",
        "ativo" => "boolean",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Auth\Models\User::class);
    }

    public function investimento(): BelongsTo
    {
        return $this->belongsTo(Investimento::class);
    }

    public function ativo(): BelongsTo
    {
        return $this->belongsTo(Ativo::class);
    }

    public function dividendos(): HasMany
    {
        return $this->hasMany(Dividendo::class);
    }
}
