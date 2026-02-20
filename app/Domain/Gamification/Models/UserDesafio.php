<?php

namespace App\Domain\Gamification\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDesafio extends Model
{
    protected $table = "user_desafios";

    protected $fillable = ["user_id", "desafio_id", "progresso", "concluido_em"];

    protected $casts = [
        "progresso" => "integer",
        "concluido_em" => "datetime",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function desafio(): BelongsTo
    {
        return $this->belongsTo(Desafio::class);
    }
}
