<?php

namespace App\Services\Hotel;

use App\Repositories\HotelSupportFacilityRepository;

class Facility
{
    private $supportFacilityRepo;

    public function __construct(HotelSupportFacilityRepository $hotelSupportFacilityRepo)
    {
        $this->supportFacilityRepo = $hotelSupportFacilityRepo;
    }

    public function getHotelSupportFacilities(int $hotelId)
    {
        $result = [];

        $collection = $this->supportFacilityRepo->getByHotelId($hotelId);

        foreach ($collection as $entity) {
            if (is_null($entity->facility)) {
                continue;
            }
            if (is_null($entity->facility->group) || is_null($entity->facility->name)) {
                continue;
            }

            $result[$entity->facility->group][] = [
                'name' => $entity->facility->name,
                'icon' => $entity->facility->icon
            ];
        }

        return $result;
    }
}