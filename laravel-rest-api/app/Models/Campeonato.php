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

    public function fases()
    {
        $fases = array(
            1 => [
                'nome' => 'quartas de final',
                'numero_jogos' => 4,
                'eliminatoria' => 1,
                'chave' => 'quartas-final'
            ],
            2 => [
                'nome' => 'semifinais',
                'numero_jogos' => 2,
                'eliminatoria' => 0,
                'chave' => 'semifinal'
            ]
        );

        return $fases;
    }

    public function participantes(): HasMany
    {
        return $this->hasMany(Participante::class);
    }
}
