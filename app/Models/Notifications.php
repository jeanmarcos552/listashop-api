<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'user_send',
        'user_receiver',
        'status',
        'lista',
    ];

    public function user_send()
    {
        return $this->belongsTo(User::class, "user_send");
    }

    public function user_receiver()
    {
        return $this->belongsTo(User::class, "user_receiver");
    }

    public function lista()
    {
        return $this->belongsTo(Lista::class, "lista");
    }
}
