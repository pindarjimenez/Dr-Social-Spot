<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\PostComment', 'post_id', 'id');
    }
    
    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'post_id', 'id');
    }

    public function shares()
    {
        return $this->hasMany('App\Models\Share', 'post_id', 'id');
    }
}
