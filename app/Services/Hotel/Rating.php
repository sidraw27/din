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
                'avg' => 0.0,
                'promotion' => ''
            ],
            'detail' => []
        ];

        /** @var HotelRating $entity */
        $entity = $this->ratingRepo->getByHotelId($hotelId);

        $mapping = [
            'agoda' => [
                'overall'  => '整體狀況滿意度',
                'facility' => '設施與設備',
                'position' => '地理位置',
                'service'  => '服務滿意度',
                'cp'       => 'CP值'
            ],
            'booking' => [
                'quality'     => '服務品質',
                'facility'    => '設施與設備',
                'clear'       => '清潔滿意度',
                'comfortable' => '舒適度',
                'cp'          => '性價比',
                'position'    => '地理位置',
                'free_wifi'   => '免費網路',
            ]
        ];

        $totalScore = 0;
        $totalNums  = 0;

        if (is_null($entity)) {
            return $result;
        }

        foreach ($mapping as $type => $item) {
            if (is_null($entity->getAttribute($type))) {
                continue;
            }

            $scores = $entity->getAttribute($type);

            foreach ($item as $alias => $description) {
                $score = $scores->getAttribute($alias);
                $totalScore += $score;
                $totalNums++;

                $result['detail'][$type][] = [
                    'alias'       => $alias,
                    'description' => $description,
                    'score'       => $score
                ];
            }
        }

        $result['statistics']['sum'] = $totalScore;
        if ($totalNums > 0) {
            $result['statistics']['avg'] = round(($totalScore / $totalNums) / 10, 1);

            $promoText = [
                '不佳',
                '稍微不佳',
                '普通',
                '優良',
                '極度優良'
            ];
            $totalText = count($promoText);
            $weight = $totalText / 10;
            $scoreKey = round($result['statistics']['avg'] * $weight);
            $result['statistics']['promotion'] = $promoText[(int) $scoreKey];
        }

        return $result;
    }
}