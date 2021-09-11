<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    // ホワイトリスト
    protected $fillable = [
        'user_id',
        'title',
        'body'
    ];
}
