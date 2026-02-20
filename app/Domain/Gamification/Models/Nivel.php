<?php

namespace App\Domain\Gamification\Models;

use App\Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nivel extends Model
{
    protected $fillable = ["nome", "nivel", "xp_minimo", "xp_maximo", "icone", "cor", "ativo"];

    protected $casts = [
        "nivel" => "integer",
        "xp_minimo" => "integer",
        "xp_maximo" => "integer",
        "ativo" => "boolean",
    ];

    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class, "nivel_id");
    }

    public function conquistas(): HasMany
    {
        return $this->hasMany(Conquista::class);
    }
}
