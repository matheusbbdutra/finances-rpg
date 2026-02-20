<?php

namespace App\Domain\Gamification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Conquista extends Model
{
    protected $fillable = [
        "nivel_id",
        "nome",
        "descricao",
        "tipo",
        "meta",
        "recompensa_xp",
        "recompensa_moeda",
        "icone",
        "cor",
        "ativo",
    ];

    protected $casts = [
        "meta" => "integer",
        "recompensa_xp" => "integer",
        "recompensa_moeda" => "integer",
        "ativo" => "boolean",
    ];

    public function nivel(): BelongsTo
    {
        return $this->belongsTo(Nivel::class);
    }

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(\App\Domain\Auth\Models\User::class, "user_conquistas")
            ->withPivot("desbloqueado_em")
            ->withTimestamps();
    }
}
