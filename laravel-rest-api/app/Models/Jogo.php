<?php

namespace App\Models;

use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class Jogo extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    const CREATED_AT = 'data_criacao';

    public function campeonato(): BelongsTo
    {
        return $this->belongsTo(Campeonato::class);
    }

    public static function getResultadoRandom() : array
    {
        // @TODO gerar resultado no python
        $resultados[0] = random_int(0,8);
        $resultados[1] = random_int(0,8);

        return $resultados;
    }
    
}
