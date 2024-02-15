<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    protected $fillable = [
        'id_venda', 'vencimento', 'valor'
    ];
    

    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }
}
