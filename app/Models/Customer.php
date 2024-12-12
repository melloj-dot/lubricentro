<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'name',
        'cuit_cuil',
        'adress',
        'telephone',
    ];


}
