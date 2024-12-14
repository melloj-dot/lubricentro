<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    protected $table = 'intervenciones';

    protected $fillable = [
        'dominio',
        'km',
        'pkm',
        'aceite',
        'filtroaceite',
        'filtrocomb',
        'filtroaire',
        'aceitecaja',
        'balanceo',
        'rot',
        'filtrohabitaculo',
        'aceitediferencial',
        'liqfreno',
        'fluidohidraulico',
        'refrigradiador',
        'observaciones'
    ];
}
