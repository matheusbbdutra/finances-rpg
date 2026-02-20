<?php

namespace App\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TransacaoTag extends Pivot
{
    protected $table = 'transacao_tag';

    protected $fillable = [
        'transacao_id',
        'tag_id',
    ];
}