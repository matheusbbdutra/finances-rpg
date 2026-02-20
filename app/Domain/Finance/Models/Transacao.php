<?php 

namespace App\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transacao extends Model
{
    protected $fillable = [
        "user_id",
        "conta_id",
        "cartao_id",
        "categoria_id",
        "tipo",
        "descricao",
        "valor",
        "data_transacao",
        "data_efetivacao",
        "status",
        "parcelas",
        "conta_destino_id",
        "transacao_origem_id",
        "observacoes",
        "localizacao",
    ];

    protected $casts = [
        "valor" => "decimal:2",
        "data_transacao" => "date",
        "data_efetivacao" => "date",
        "parcelas" => "integer",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Auth\Models\User::class);
    }

    public function conta(): BelongsTo
    {
        return $this->belongsTo(Conta::class);
    }

    public function contaDestino(): BelongsTo
    {
        return $this->belongsTo(Conta::class, "conta_destino_id");
    }

    public function cartao(): BelongsTo
    {
        return $this->belongsTo(Cartao::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function transacaoOrigem(): BelongsTo
    {
        return $this->belongsTo(Transacao::class, "transacao_origem_id");
    }

    public function transacoesFilhas(): HasMany
    {
        return $this->hasMany(Transacao::class, "transacao_origem_id");
    }

    public function parcelas(): HasMany
    {
        return $this->hasMany(Parcela::class);
    }
}
