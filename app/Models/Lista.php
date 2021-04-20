<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function item()
    {
        return $this->belongsToMany(Itens::class);
    }
}
