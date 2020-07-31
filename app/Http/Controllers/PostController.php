<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;

class PostController extends Controller
{   
    /** @var PostService $postService */
    protected $postService;

    /**
     * PostController constructor.
     */
    public function __construct(PostService $postService) 
    {
        $this->postService = $postService;
    }

    public function index()
    {
        return view('pages.index');
    }

    public function submitPost(Request $request)
    {
        return $this->postService->create($request->all());
    }

    public function getNewsFeed()
    {
        return $this->postService->getNewsFeed();
    }

    public function getNewsFeedByUser()
    {
        return $this->postService->getNewsFeedByUser();
    }

    public function submitComment(Request $request)
    {
        return $this->postService->addComment($request->all());
    }

    public function likePost(Request $request)
    {
        return $this->postService->likePost($request->all());
    }

    public function likeSharedPost(Request $request)
    {
        return $this->postService->likeSharedPost($request->all());
    }

    public function sharePost(Request $request)
    {
        return $this->postService->sharePost($request->all());
    }
}
