<?php

namespace App\Services\Hotel;

use App\Entities\HotelRating;
use App\Repositories\HotelRatingRepository;

class Rating
{
    private $ratingRepo;

    public function __construct(HotelRatingRepository $hotelRatingRepo)
    {
        $this->ratingRepo = $hotelRatingRepo;
    }

    public function getHotelRating(int $hotelId)
    {
        $result = [
            'statistics' => [
                'sum' => 0,
                'avg' => 0.0
            ],
            'detail'     => []
        ];

        /** @var HotelRating $entity */
        $entity = $this->ratingRepo->getByHotelId($hotelId);

        $mapping = [
            'overall'  => '整體狀況滿意度',
            'facility' => '設施與設備',
            'position' => '地理位置',
            'service'  => '服務滿意度',
            'cp'       => 'CP值',
        ];

        foreach ($mapping as $alias => $description) {
            if (is_null($entity->getAttribute($alias))) continue;

            $result['detail'][] = [
                'alias'       => $alias,
                'description' => $description,
                'score'       => $entity->getAttribute($alias)
            ];
        }

        $result['statistics']['sum'] = 0;

        foreach ($result['detail'] as $rating) {
            $result['statistics']['sum'] += $rating['score'];
        }

        $detailTotal = count($result['detail']);
        if ($detailTotal > 0) {
            $result['statistics']['avg'] = round(($result['statistics']['sum'] / $detailTotal) / 10, 1);
        }

        return $result;
    }
}