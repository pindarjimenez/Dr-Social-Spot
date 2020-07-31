<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    /**
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_from_id',
        'post_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function userFrom()
    {
        return $this->belongsTo('App\Models\User', 'user_from_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
    
    public function likes()
    {
        return $this->hasMany('App\Models\SharedLike', 'share_id', 'id');
    }
}
