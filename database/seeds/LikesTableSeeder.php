<?php

use Illuminate\Database\Seeder;
use App\Models\Like;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $likes[] = [
            'user_id' => 1,
            'post_id' => 1
        ];

        $likes[] = [
            'user_id' => 1,
            'post_id' => 4
        ];
        
        $likes[] = [
            'user_id' => 2,
            'post_id' => 3
        ];
        
        $likes[] = [
            'user_id' => 2,
            'post_id' => 4
        ];

        $likes[] = [
            'user_id' => 3,
            'post_id' => 4
        ];

        foreach($likes as $like) {
            Like::create($like);
        }
    }
}
