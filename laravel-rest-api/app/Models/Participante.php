<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participante extends Model
{
    use HasFactory;

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = ['time_id', 'pontuacao', 'eliminado'];

    public function campeonato(): BelongsTo
    {
        return $this->belongsTo(Campeonato::class);
    }
}
