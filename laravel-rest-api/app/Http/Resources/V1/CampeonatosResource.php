<?php

namespace App\Http\Resources\V1;

use App\Models\Jogo;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampeonatosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'jogos' => JogosResource::collection($this->jogos),
            'finalistas' => ParticipantesResource::collection($this->getFinalistas())
        ];
    }
}
