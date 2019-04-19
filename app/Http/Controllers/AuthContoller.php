<?php

namespace App\Http\Controllers;

use App\Enum\SocialiteProviderEnum;
use App\Services\UserService;

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

        return redirect()->back();
    }

    public function authentication(string $provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        if (\Auth::check()) {
            return redirect()->back();
        }

        $checkDeniedProvider = [
            SocialiteProviderEnum::FACEBOOK
        ];

        if (in_array($provider, $checkDeniedProvider) && ( ! \Request::has('code') || \Request::has('denied'))) {
            return redirect()->back();
        }

        if ($this->userService->login($provider)) {
            return redirect()->intended(route('index'));
        }

        return redirect()->back();
    }
}