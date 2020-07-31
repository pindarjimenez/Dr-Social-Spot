<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
