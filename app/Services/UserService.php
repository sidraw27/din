<?php

namespace App\Services;

use App\Services\User\Acl;
use App\Services\User\Auth;

class UserService
{
    private $acl;
    private $auth;

    public function __construct(Auth $auth, Acl $acl)
    {
        $this->auth = $auth;
        $this->acl = $acl;
    }

    public function login(string $provider)
    {
        $providerUser = \Socialite::driver($provider)->stateless()->user();

        $user = $this->auth->register($providerUser, $provider);

        return ( ! is_null(\Auth::loginUsingId($user->id, true)));
    }
}