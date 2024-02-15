<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;   
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Authenticatable
{
    use HasFactory;

    protected $filable = [
        'nome',
        'password',
        'cpf',
        'email'
    ];

    protected $table = 'vendedores';
}
