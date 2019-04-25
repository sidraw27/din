<?php

namespace App\Repositories;

use App\Traits\CacheTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class AbstractRepository
{
    use CacheTrait;

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
    public function getById(int $id, array $columns = ['*'])
    {
        if (is_null($result = $this->entity->find($id, $columns))) {
            throw new ModelNotFoundException("Not Found");
        }

        return $result;
    }

    /**
     * @param array $ids
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByIds(array $ids, array $columns = ['*'])
    {
        $result = $this->entity->findMany($ids, $columns);

        if ($result->isEmpty()) {
            throw new ModelNotFoundException('Not Found');
        }

        return $result;
    }

    public function getTotal()
    {
        return $this->entity->count(['id']);
    }

    public function getByRange(int $skip, int $limit, array $columns = ['*'])
    {
        return $this->entity
            ->skip($skip)
            ->limit($limit)
            ->get($columns);
    }
}