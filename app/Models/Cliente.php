<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'numero_identificacion',
        'telefono',
        'correo',
    ];

    public function soportes()
    {
        return $this->hasMany(Soporte::class);
    }
}
