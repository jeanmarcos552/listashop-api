<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensLista extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty',
    ];
    protected $table = "itens_listas";
}
