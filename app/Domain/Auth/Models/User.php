<?php

namespace App\Domain\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Domain\Finance\Models\Conta;
use App\Domain\Finance\Models\Cartao;
use App\Domain\Finance\Models\Transacao;
use App\Domain\Finance\Models\Meta;
use App\Domain\Finance\Models\Orcamento;
use App\Domain\Investiment\Models\Investimento;
use App\Domain\Gamification\Models\Nivel;
use App\Domain\Gamification\Models\Conquista;
use App\Domain\Gamification\Models\Desafio;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        "name",
        "email",
        "password",
        "avatar",
        "xp_total",
        "nivel_id",
        "streak_dias",
        "ultimo_acesso",
        "moeda_padrao",
        "timezone",
    ];

    protected $hidden = ["password", "remember_token"];

    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
            "ultimo_acesso" => "datetime",
        ];
    }

    public function contas(): HasMany
    {
        return $this->hasMany(Conta::class);
    }

    public function cartoes(): HasMany
    {
        return $this->hasMany(Cartao::class);
    }

    public function transacoes(): HasMany
    {
        return $this->hasMany(Transacao::class);
    }

    public function investimentos(): HasMany
    {
        return $this->hasMany(Investimento::class);
    }

    public function metas(): HasMany
    {
        return $this->hasMany(Meta::class);
    }

    public function orcamentos(): HasMany
    {
        return $this->hasMany(Orcamento::class);
    }

    public function nivel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Nivel::class, "nivel_id");
    }

    public function conquistas(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Conquista::class, "user_conquistas")
            ->withPivot("desbloqueado_em")
            ->withTimestamps();
    }

    public function desafios(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Desafio::class, "user_desafios")
            ->withPivot("progresso", "concluido_em")
            ->withTimestamps();
    }
}
