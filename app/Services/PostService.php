<?php

namespace App\Services;

use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Eloquent\ShareRepository;
use Auth;

class PostService
{

    /** @var PostRepository $postRepository */
    protected $postRepository;

    /** @var ShareRepository $shareRepository */
    protected $shareRepository;

    /**
     * PostService constructor.
     */
    public function __construct(
        PostRepository $postRepository,
        ShareRepository $shareRepository
    ) {
        $this->postRepository = $postRepository;
        $this->shareRepository = $shareRepository;
    }

    public function create($data)
    {
        $post = $this->postRepository->create([
            'user_id' => Auth::user()->id,
            'content' => $data['content'],
        ]);

        return $post->load(['user', 'comments.user', 'likes', 'shares']);
    }

    public function getNewsFeed()
    {
        $sharedFeed = $this->shareRepository->with(['user', 'userFrom', 'post', 'likes'])->get();
        $newFeed = $this->postRepository->with(['user', 'comments.user', 'likes', 'shares'])->get();
        $merged = $newFeed->concat($sharedFeed);
        
        return $merged->all();
    }

    public function getNewsFeedByUser()
    {
        
        $sharedFeed = $this->shareRepository->with(['user', 'userFrom', 'post', 'likes'])
                        ->where('user_id', Auth::user()->id)
                        ->get();
        $newFeed = $this->postRepository->with(['user', 'comments.user', 'likes', 'shares'])
                        ->where('user_id', Auth::user()->id)
                        ->get();
        $merged = $newFeed->merge($sharedFeed)->sortByDesc('created_at');
        

        return $merged->all();
    }

    public function addComment($data)
    {
        $post = $this->postRepository->find($data['post_id']);
        $comment = $post->comments()->create([
            'user_id' => Auth::user()->id,
            'comment' => $data['comment'],
        ]);

        return $comment->load('user');
    }

    public function likePost($data)
    {
        $post = $this->postRepository->find($data['post_id']);
        $checkUserLike = $post->likes()->where('user_id', Auth::user()->id)->first();
        if($checkUserLike) {
            return $post->likes()->where('user_id', Auth::user()->id)->delete();
        } else {
            return $post->likes()->create([
                'user_id' => Auth::user()->id
            ]);
        }
    }

    public function likeSharedPost($data)
    {
        $post = $this->shareRepository->find($data['share_id']);
        $checkUserLike = $post->likes()->where('user_id', Auth::user()->id)->first();
        if($checkUserLike) {
            return $post->likes()->where('user_id', Auth::user()->id)->delete();
        } else {
            return $post->likes()->create([
                'user_id' => Auth::user()->id
            ]);
        }
    }

    public function sharePost($data)
    {
        $post = $this->postRepository->find($data['post_id']);
        $shared = $post->shares()->create([
            'user_id' => Auth::user()->id,
            'user_from_id' => $data['user_from_id']
        ]);

        
        return $shared->load(['user', 'userFrom', 'post', 'likes']);
    }
}
