<?php

namespace App\Services\User;

use App\Repositories\UserRepository;

class Auth
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(\Laravel\Socialite\Two\User $providerUser, string $provider)
    {
        $user = $this->userRepo->getByProviderUserId($providerUser->getId());

        if (is_null($user)) {
            $user = $this->userRepo->create([
                'provider_user_id' => $providerUser->getId(),
                'origin_name'      => $providerUser->getName(),
                'display_name'     => $providerUser->getName(),
                'avatar'           => $providerUser->getAvatar(),
                'email'            => $providerUser->getEmail(),
                'provider'         => $provider
            ]);
        }

        return $user;
    }
}