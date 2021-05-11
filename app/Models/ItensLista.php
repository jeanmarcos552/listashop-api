<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensLista extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty',
        'status',
        'value'
    ];
    protected $table = "itens_listas";
}
