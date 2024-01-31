<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class Campeonato extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    const CREATED_AT = 'data_criacao';

    protected $fillable = ['nome', 'campeonato_nome', 'participantes'];

    public function participantes(): HasMany
    {
        return $this->hasMany(Participante::class);
    }

    public function jogos(): HasMany
    {
        return $this->hasMany(Jogo::class, 'campeonato_id');
    }

    public function getFinalistas() {

        $finalistas = Participante::where('campeonato_id', '=', $this->id)
        ->where('classificacao', '<>', null)
        ->get();

        return $finalistas;
    }

    public static function gerar($campeonato)
    {       
        $faseQuartasFinal = Fase::where('chave', '=', 'quartas-final')->first();
        $faseSemifinais = Fase::where('chave', '=', 'semifinal')->first();

        // quartas de final
        $participantes = Campeonato::getTimesAptos($campeonato->id);
        Campeonato::gerarRodadaDeJogos($campeonato->id, $participantes, $faseQuartasFinal);

        // semifinais
        $participantes = Campeonato::getTimesAptos($campeonato->id);
        Campeonato::gerarRodadaDeJogos($campeonato->id, $participantes, $faseSemifinais);
        
        // disputa classificatoria
        Campeonato::disputaClassificatoria($campeonato->id);

        //define hanking
        Campeonato::defineHanking($campeonato->id);
    }

    public static function gerarRodadaDeJogos($campeonatoId, $participantes, $fase) 
    {               
        for ($i = 1; $i<=  $fase->numero_jogos; $i++) {

            $timesEscolhidos = array_rand($participantes, 2);            
            $t1 = $timesEscolhidos[0];
            $t2 = $timesEscolhidos[1];
            
            $resultados = Jogo::getResultadoRandom();

            $jogo = New Jogo();
            $jogo->fase_id = $fase->id;
            $jogo->campeonato_id = $campeonatoId;
            $jogo->time_casa_id = $participantes[$t1]['id'];
            $jogo->time_fora_id = $participantes[$t2]['id'];
            $jogo->pontuacao_timecasa = $resultados[0];
            $jogo->pontuacao_timefora = $resultados[1];
            $jogo->save();

            unset($participantes[$t1]);
            unset($participantes[$t2]);

            Campeonato::atualizaPontuacao($jogo);

            if ($fase->eliminatoria) {
                Campeonato::definiEliminados($jogo, $resultados);           
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

    public static function disputaClassificatoria($campeonatoId) {

        $faseSemifinais = Fase::where('chave', '=', 'semifinal')->first();
        $faseClassificatoria = Fase::where('chave', '=', 'classificatoria')->first();

        $jogosSemifinal = Jogo::where('fase_id', '=', $faseSemifinais->id)
            ->where('campeonato_id', '=', $campeonatoId)
            ->get();

        $disputaTerceiroLugar = [];
        $disputaPrimeiroLugar = [];

        foreach ($jogosSemifinal as $jogo) {
            if ($jogo->pontuacao_time_casa <= $jogo->pontuacao_time_fora) {
                $disputaTerceiroLugar[] = Participante::where('id', $jogo->time_casa_id)->first();
                $disputaPrimeiroLugar[] = Participante::where('id',$jogo->time_fora_id)->first();
            } else {
                $disputaTerceiroLugar[] = Participante::where('id',$jogo->time_fora_id)->first();
                $disputaPrimeiroLugar[] = Participante::where('id',$jogo->time_casa_id)->first();
            }
        }

        Campeonato::gerarRodadaDeJogos($campeonatoId, $disputaTerceiroLugar, $faseClassificatoria);
        Campeonato::gerarRodadaDeJogos($campeonatoId, $disputaPrimeiroLugar, $faseClassificatoria);
    }

    public static function defineHanking($campeonatoId) {

        $faseClassificatoria = Fase::where('chave', '=', 'classificatoria')->first();

        $finalistas = DB::table('participantes')
            ->join('jogos', function (JoinClause $join) {
            $join->on('jogos.time_casa_id', '=', 'participantes.id');
            $join->orOn('jogos.time_fora_id', '=', 'participantes.id');

        })
        ->where('jogos.fase_id',  '=', $faseClassificatoria->id)
        ->where('participantes.campeonato_id', '=', $campeonatoId)
        ->orderBy('participantes.pontuacao', 'DESC')
        ->limit(3)
        ->select('participantes.id')
        ->get();

        $primeiroLugar = Participante::where('id', '=', $finalistas[0]->id)->first();
        $primeiroLugar->classificacao = 1;
        $primeiroLugar->save();

        $segundoLugar = Participante::where('id', '=', $finalistas[1]->id)->first();
        $segundoLugar->classificacao = 2;
        $segundoLugar->save();

        $terceiroLugar = Participante::where('id', '=', $finalistas[2]->id)->first();
        $terceiroLugar->classificacao = 3;
        $terceiroLugar->save();
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

        } else if($gols_time_casa == $gols_time_fora) {
            if ($timeCasa->data_criacao < $timeFora->data_criacao) {
                $timeFora->eliminado = '1';
            } else {
                $timeCasa->eliminado = '1';
            }
        } else {
            $timeFora->eliminado = '1';
        }                 
        
        $timeCasa->save();
        $timeFora->save();
                                  
    }

}
