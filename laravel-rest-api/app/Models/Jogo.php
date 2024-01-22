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
        
        $faseQuartasFinal = Fase::where('chave' , 'quartas-final');
        $faseSemifinais = Fase::where('chave' , 'semifinal');

        $participantes = Jogo::getTimesAptos($campeonato->id);
        Jogo::gerarRodadaDeJogos($participantes, $faseQuartasFinal);

        // semifinais
        $participantes = Jogo::getTimesAptos($campeonato->id);
        Jogo::gerarRodadaDeJogos($participantes, $faseSemifinais);
        
        // terceiro lugar

        // primeiro e segundo lugar

        
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
        // salvar pontuacoes
        $timeCasa = Participante::find($jogo->time_casa_id);
        $timeCasa->pontuacao += $jogo->pontuacao_timecasa;            

        $timeFora = Participante::find($jogo->time_fora_id);
        $timeFora->pontuacao += $jogo->pontuacao_timecasa;

        $fase = $jogo->fase;

        if ($fase->eliminatoria) {
            if ($timeCasa->pontuacao < $timeFora->pontuacao) {
                $timeCasa->eliminado = '1';
            } elseif ($timeCasa->pontuacao == $timeFora->pontuacao) {
                $timeFora->eliminado = '1'; //  somente para teste        
               // criterios de desempate
            } else{
                $timeFora->eliminado = '1';
            }
        }

        $timeCasa->save();
        $timeFora->save();

        if ($fase->chave == 'semifinal') {
            Jogo::hankingVencedores();
        }
    }

    public static function definiEliminados($timeCasa, $timeFora) {
        
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
