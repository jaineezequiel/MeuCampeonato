<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campeonato extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = ['nome', 'campeonato_nome', 'participantes'];

    public function participantes(): HasMany
    {
        return $this->hasMany(Participante::class);
    }

    public function jogos(): HasMany
    {
        return $this->hasMany(Jogo::class);
    }

    public function getFinalistas() {

        $finalistas = Participante::where('campeonato_id', '=', $this->id)
        ->where('classificacao', '<>', null)
        ->get();

        return $finalistas;
    }
}
