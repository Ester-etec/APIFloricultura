<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planta extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'nome',
        'valor'
    ];

    public function plantfore()
    {
        return $this->hasMany(compra::class);
    }

}
