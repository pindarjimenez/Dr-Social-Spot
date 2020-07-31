<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    /**
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
