<?php

namespace App\Repositories;

use App\Entities\District;

class DistrictRepository extends AbstractRepository
{
    /**
     * DistrictRepository constructor.
     * @param District | \Illuminate\Database\Eloquent\Builder $entity
     */
    public function __construct(District $entity)
    {
        $this->entity = $entity;
        $this->setPrefix('District:');
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