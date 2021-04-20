<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itens extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ativo',
    ];

    public function lista()
    {
        return $this->belongsToMany(Lista::class);
    }
}
