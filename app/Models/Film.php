<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional, Laravel lo deduce bien)
    protected $table = 'films';

    // Campos que se pueden rellenar en masa
    protected $fillable = [
        'name',
        'year',
        'genre',
        'country',
        'duration',
        'img_url',
    ];
    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }
}
