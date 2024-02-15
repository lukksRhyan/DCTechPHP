<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Vendedor;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendedor_id',
        'cliente_id',
        'forma_pagamento',
        'valor_total'
    ];

    protected $table = 'vendas';

    public function __construct()
    {
    }
}
