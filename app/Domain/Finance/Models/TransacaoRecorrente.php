<?php

namespace App\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransacaoRecorrente extends Model
{
    protected $table = 'transacao_recorrente';

    protected $fillable = [
        'recorrencia_id',
        'transacao_id',
        'data_gerada',
    ];

    protected $casts = [
        'data_gerada' => 'date',
    ];

    public function recorrencia(): BelongsTo
    {
        return $this->belongsTo(Recorrencia::class);
    }

    public function transacao(): BelongsTo
    {
        return $this->belongsTo(Transacao::class);
    }
}