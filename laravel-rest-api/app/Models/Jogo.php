<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jogo extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    const CREATED_AT = null;

    public static function gerar(Array $jogadores)
    {
        //while (!empty($jogadores)) {

            $selecionaTimesPartida = array_rand($jogadores, 2);            
            $t1 = $selecionaTimesPartida[0];
            $t2 = $selecionaTimesPartida[1];

            //@TODO gerar resultado no python
            $resultado[0] = '3';
            $resultado[1] = '0';

            $jogo = New Jogo();
            $jogo->fase_id =NULL;
            $jogo->time_casa_id = $jogadores[$t1]['id'];
            $jogo->time_fora_id = $jogadores[$t2]['id'];
            $jogo->pontuacao_timecasa = $resultado[0];
            $jogo->pontuacao_timefora = $resultado[1];
            $jogo->save();
                    
            unset($jogadores[$t1]);
            unset($jogadores[$t2]);

           // echo "<pre";
           // dd($t1, $t2, $jogadores);

            //Jogo::gerar($jogadores);
        //}
    }
}
