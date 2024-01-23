<?php

namespace App\Models;

use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jogo extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    const CREATED_AT = null;

    public static function gerar($campeonato)
    {       
        $faseQuartasFinal = Fase::where('chave', '=', 'quartas-final')->first();
        $faseSemifinais = Fase::where('chave', '=', 'semifinal')->first();
        $faseClassificatoria = Fase::where('chave', '=', 'classificatoria')->first();

        $participantes = Jogo::getTimesAptos($campeonato->id);
        Jogo::gerarRodadaDeJogos($participantes, $faseQuartasFinal);

        // semifinais
        $participantes = Jogo::getTimesAptos($campeonato->id);
        Jogo::gerarRodadaDeJogos($participantes, $faseSemifinais);
        
        // define Hanking
        //$participantes = Jogo::getTimesAptos($campeonato->id);

        //Jogo::gerarRodadaDeJogos($participantes, $faseClassificatoria);

        // primeiro e segundo lugar
        //Jogo::gerarRodadaDeJogos($participantes, $faseClassificatoria);    
    }

    public static function gerarRodadaDeJogos($participantes, $fase) 
    {               
        for ($i = 1; $i<=  $fase->numero_jogos; $i++) {

            $timesEscolhidos = array_rand($participantes, 2);            
            $t1 = $timesEscolhidos[0];
            $t2 = $timesEscolhidos[1];
            
            $resultados = Jogo::getResultadoRandom();

            $jogo = New Jogo();
            $jogo->fase_id = $fase->id;
            $jogo->time_casa_id = $participantes[$t1]['id'];
            $jogo->time_fora_id = $participantes[$t2]['id'];
            $jogo->pontuacao_timecasa = $resultados[0];
            $jogo->pontuacao_timefora = $resultados[1];
            $jogo->save();

            unset($participantes[$t1]);
            unset($participantes[$t2]);

            Jogo::atualizaPontuacao($jogo);

            if ($fase->eliminatoria) {
                Jogo::definiEliminados($jogo, $resultados);           
            }
        }          
    }

    public static function getTimesAptos(int $campeonatoId) : array
    {
        $participantes = Participante::where('campeonato_id', '=' , $campeonatoId)
        ->where('eliminado', '=', '0')
        ->get()->toArray();

        return $participantes;
    }

    public static function atualizaPontuacao($jogo)
    {
        $timeCasa = Participante::find($jogo->time_casa_id);
        $timeCasa->pontuacao += $jogo->pontuacao_timecasa;            
        $timeCasa->save();

        $timeFora = Participante::find($jogo->time_fora_id);
        $timeFora->pontuacao += $jogo->pontuacao_timefora;        
        $timeFora->save();        
    }

    public static function definiEliminados($jogo, $resultados) 
    {            
        $timeCasa = Participante::find($jogo->time_casa_id);    
        $timeFora = Participante::find($jogo->time_fora_id);  

        $gols_time_casa = $resultados[0];
        $gols_time_fora = $resultados[1];

        if ($gols_time_casa < $gols_time_fora) {        
            $timeCasa->eliminado = '1'; 
            $timeCasa->save();
        } else {
            $timeFora->eliminado = '1';
            $timeFora->save();
        }                               
    }

    public static function getResultadoRandom() : array
    {
        // @TODO gerar resultado no python
        $resultados[0] = random_int(0,8);
        $resultados[1] = random_int(0,8);

        return $resultados;
    }

    public static function hankingVencedores() 
    {

    }
}
