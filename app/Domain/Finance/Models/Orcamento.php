<?php 

namespace App\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orcamento extends Model
{
    protected $fillable = ["user_id", "categoria_id", "nome", "valor_limite", "valor_gasto", "ano", "mes", "ativo"];

    protected $casts = [
        "valor_limite" => "decimal:2",
        "valor_gasto" => "decimal:2",
        "ano" => "integer",
        "mes" => "integer",
        "ativo" => "boolean",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Auth\Models\User::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}
