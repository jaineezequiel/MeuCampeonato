<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campeonato extends Model
{
    use HasFactory;

    public function fases()
    {
        $fases = array(
            1 => ['nome' => 'quartas de final)', 'numero_jogos' => 4],
            2 => ['nome' => 'semifinais', 'numero_jogos' => 2],
        );

        return $fases;
    }
}
