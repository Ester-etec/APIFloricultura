<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'valortotal',
        'quantidade',
        'id_planta',
        'id_cliente',
        'id_funcinario'
    ];
    
    function plant()
    {
        return $this->belongsTo(planta::class);
    }

    public function clie()
    {
        return $this->belongsTo(cliente::class);
    }

    function funcio()
    {
        return $this->belongsTo(funcionario::class);
    }

}

 
