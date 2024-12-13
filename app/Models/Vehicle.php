<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'autos';

    protected $primaryKey = 'ID';

    protected $fillable = [
        'Modelo',
        'Dominio',
        'Aceite',
        'ADiferencial',
        'NCubiertas',
        'NPropietario',
        'CuitCuil'
    ];
}
