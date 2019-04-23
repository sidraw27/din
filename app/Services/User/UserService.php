<?php

namespace App\Services\User;

class UserService
{
    private $acl;
    private $auth;

    public function __construct(Auth $auth, Acl $acl)
    {
        $this->auth = $auth;
        $this->acl = $acl;
    }

    /**
     * @param string $provider
     * @return bool
     */
    public function login(string $provider)
    {
        $providerUser = \Socialite::driver($provider)->stateless()->user();

        $user = $this->auth->register($providerUser, $provider);

        return ( ! is_null(\Auth::loginUsingId($user->id, true)));
    }
}