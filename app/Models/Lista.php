<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'category_id',
    ];

    public function itens()
    {
        return $this->belongsToMany(Itens::class, 'itens_listas')
            ->withPivot([
                'qty',
                'value',
                'status'
            ]);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'lista_users');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
