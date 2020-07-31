<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharedLike extends Model
{
    /**
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'share_id',
    ];
}
