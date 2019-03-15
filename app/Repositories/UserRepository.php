<?php

namespace App\Repositories;

use App\Entities\User;

class UserRepository extends AbstractRepository
{
    /**
     * UserRepository constructor.
     * @param User | \Illuminate\Database\Eloquent\Builder $entity
     */
    public function __construct(User $entity)
    {
        $this->entity = $entity;
    }

    public function getByProviderUserId(string $originUserId, array $columns = ['*'])
    {
        return $this->entity->where('provider_user_id', $originUserId)->first($columns);
    }
}