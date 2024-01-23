<?php

namespace App\Http\Resources\V1;

use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JogosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "fase_id" => $this->fase_id,
            "time_casa_id" =>  $this->time_casa_id,
            "pontuacao_timecasa"=>  $this->pontuacao_timecasa,
            "time_fora_id"=>  $this->time_fora_id,
            "pontuacao_timefora"=>  $this->pontuacao_timefora,
        ];
    }
}
