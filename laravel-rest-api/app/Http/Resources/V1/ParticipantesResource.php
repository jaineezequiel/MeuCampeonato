<?php

namespace App\Http\Resources\V1;

use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "time" =>  Time::whereId($this->time_id)->first()->nome,
            "pontuacao" => $this->pontuacao,
            "classificacao" => $this->classificacao
        ];
    }
}