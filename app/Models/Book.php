<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $casts = [
        'detail' => 'json',
    ];

    /**
     * 所持しているユーザー
     */
    public function users()
    {
        $this->belongsToMany(User::class);
    }
}
