<?php

namespace App\Domain\Gamification\Models;

use App\Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserConquista extends Model
{
    protected $table = "user_conquistas";

    protected $fillable = ["user_id", "conquista_id", "desbloqueado_em"];

    protected $casts = [
        "desbloqueado_em" => "datetime",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function conquista(): BelongsTo
    {
        return $this->belongsTo(Conquista::class);
    }
}
