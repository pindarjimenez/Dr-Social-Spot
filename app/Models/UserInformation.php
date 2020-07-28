<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $table = 'user_informations';
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'mobile',
        'gender',
        'birthdate',
        'address',
        'age',
    ];
}
