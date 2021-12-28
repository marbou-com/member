<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //フォームで投稿される内容を記述する
    protected $fillable=[
        'title',
        'body',
        'user_id',
        'image'
    ];

    //コメント取得　主→従
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    //一つの投稿が一人のユーザーに紐づく
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}

