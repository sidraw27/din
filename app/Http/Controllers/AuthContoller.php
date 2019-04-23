<?php

namespace App\Http\Controllers;

use App\Enum\SocialiteProviderEnum;
use App\Services\User\UserService;

class AuthController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function logout()
    {
        \Auth::logout();

        return redirect()->route('list');
    }

    public function authentication(string $provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        if (\Auth::check()) {
//            return redirect()->route('list');
        }

        $checkDeniedProvider = [
            SocialiteProviderEnum::FACEBOOK
        ];

        if (in_array($provider, $checkDeniedProvider) && ( ! \Request::has('code') || \Request::has('denied'))) {
//            return redirect()->route('list');
        }

        if ($this->userService->login($provider)) {
//            return redirect()->route('list');
        }

        return redirect()->route('list');
    }
}