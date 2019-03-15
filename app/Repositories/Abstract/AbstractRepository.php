<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class AbstractRepository
{
    /* @var $entity \Illuminate\Database\Eloquent\Builder */
    protected $entity;

    public function create(array $data)
    {
        return $this->entity->create($data)->first();
    }

    /**
     * @param int $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     * @throws ModelNotFoundException
     */
    public function getById(int $id, array $columns)
    {
        if (is_null($result = $this->entity->find($id, $columns))) {
            throw new ModelNotFoundException("Not Found");
        }

        return $result;
    }
}