<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;

class FriendshipRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Models\Friendship';
    }
}