<?php

namespace App\Repositories;

use App\Entities\City;

class CityRepository extends AbstractRepository
{
    /**
     * CityRepository constructor.
     * @param City | \Illuminate\Database\Eloquent\Builder $entity
     */
    public function __construct(City $entity)
    {
        $this->entity = $entity;
        $this->setPrefix('City:');
    }

    public function getWithCountry(int $id, array $columns = ['*'], $relationColumns = ['*'])
    {
        return $this->entity
            ->with([
                'country' => function ($query) use ($relationColumns) {
                    $query->select($relationColumns);
                }
            ])
            ->find($id, $columns);
    }
}