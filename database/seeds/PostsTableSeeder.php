<?php

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts[] = [
            'user_id' => 3,
            'content' => 'Happiness is not something ready made. It comes from your own actions.'
        ];

        $posts[] = [
            'user_id' => 1,
            'content' => 'Believe you can and you’re halfway there.'
        ];

        $posts[] = [
            'user_id' => 2,
            'content' => 'Two roads diverged in a wood, and I—I took the one less traveled by, And that has made all the difference.'
        ];

        $posts[] = [
            'user_id' => 1,
            'content' => 'Opportunities don’t happen. You create them.'
        ];

        foreach($posts as $post) {
            Post::create($post);
        }
    }
}
