<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\UserService;

class ProfileController extends Controller
{   
    /** @var PostService $postService */
    protected $postService;

    /** @var UserService $userService */
    protected $userService;

    /**
     * ProfileController constructor.
     */
    public function __construct(PostService $postService, UserService $userService) 
    {
        $this->postService = $postService;
        $this->userService = $userService;
    }

    public function index()
    {
        return view('pages.profile');
    }

    public function information()
    {
        return $this->userService->getInformation();
    }

    public function updateProfile(Request $request)
    {
        return $this->userService->update($request->all());
    }
}
