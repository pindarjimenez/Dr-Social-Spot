<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    /**
     *
     * @var array
     */
    protected $fillable = [
        'requester',
        'user_requested',
        'status',
    ];
}
