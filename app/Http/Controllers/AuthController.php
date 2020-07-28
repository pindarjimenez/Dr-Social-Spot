<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /** @var $userService */
    private $userService;
    /**
     * contruct
     */
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * Admin login page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        if (auth()->user()) {
            return redirect()->route('home');
        }

        return view('pages.login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function loginSubmit(LoginRequest $request)
    {
        $user = $this->userService->userLogin($request->get('email'), $request->get('password'));

        if (!empty($user)) {
            Auth::login($user);

            return response(null, Response::HTTP_OK);
        } else {
            return response(['error' => true], Response::HTTP_OK);
        }
    }

    public function registerSubmit(RegisterRequest $request)
    {
        $this->userService->create($request->all(), 'restrict');
    
        return response(null, Response::HTTP_OK);
    }
}
