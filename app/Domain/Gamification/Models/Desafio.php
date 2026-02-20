<?php

namespace App\Domain\Gamification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Desafio extends Model
{
    protected $fillable = [
        "nome",
        "descricao",
        "tipo",
        "meta",
        "recompensa_xp",
        "recompensa_moeda",
        "icones_disponiveis",
        "ativo",
    ];

    protected $casts = [
        "meta" => "integer",
        "recompensa_xp" => "integer",
        "recompensa_moeda" => "integer",
        "ativo" => "boolean",
    ];

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(\App\Domain\Auth\Models\User::class, "user_desafios")
            ->withPivot("progresso", "concluido_em")
            ->withTimestamps();
    }
}
