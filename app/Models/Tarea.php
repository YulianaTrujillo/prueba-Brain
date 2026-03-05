<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarea extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'proyecto_id',
        'titulo',
        'descripcion',
        'estado',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
    
    public static function estados(): array
    {
        return ['pendiente', 'en_progreso', 'hecha'];
    }

}
