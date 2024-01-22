<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jogo extends Model
{
    use HasFactory;

    //protected $fillable = ['fase_id', 'time_casa_id', 'time_fora_id'];

    /*public function timeDaCasa(): BelongsTo
    {
        return $this->belongsTo(Participante::class, 'time_casa_id', 'time_id');
    }

    public function timeDeFora(): BelongsTo
    {
        return $this->belongsTo(Participante::class, 'time_fora_id', 'time_id');
    }*/

}
