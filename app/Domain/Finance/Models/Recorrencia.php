<?php

namespace App\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recorrencia extends Model
{
    protected $fillable = [
        'user_id',
        'tipo_frequencia',
        'dia_frequencia',
        'data_inicio',
        'data_fim',
        'valor',
        'descricao',
        'conta_id',
        'cartao_id',
        'categoria_id',
        'tipo_transacao',
        'ativo',
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'valor' => 'decimal:2',
        'dia_frequencia' => 'integer',
        'ativo' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Domain\Auth\Models\User::class);
    }

    public function conta(): BelongsTo
    {
        return $this->belongsTo(Conta::class);
    }

    public function cartao(): BelongsTo
    {
        return $this->belongsTo(Cartao::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function transacoesGeradas(): HasMany
    {
        return $this->hasMany(TransacaoRecorrente::class);
    }
}