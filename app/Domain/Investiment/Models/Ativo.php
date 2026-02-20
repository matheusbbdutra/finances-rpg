<?php 

namespace App\Domain\Investiment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ativo extends Model
{
    protected $fillable = [
        "codigo",
        "nome",
        "tipo",
        "preco_atual",
        "variacao_dia",
        "dividend_yield",
        "p_l",
        "ultimo_update",
    ];

    protected $casts = [
        "preco_atual" => "decimal:4",
        "variacao_dia" => "decimal:4",
        "dividend_yield" => "decimal:4",
        "p_l" => "decimal:2",
        "ultimo_update" => "datetime",
    ];

    public function posicoes(): HasMany
    {
        return $this->hasMany(Posicao::class);
    }

    public function dividendos(): HasMany
    {
        return $this->hasMany(Dividendo::class);
    }
}
