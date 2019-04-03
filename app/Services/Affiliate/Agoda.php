<?php

namespace App\Services\Affiliate;

use App\Support\DateRange;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Arr;

class Agoda extends AbstractAffiliate
{
    /**
     * @param int $hotelId
     * @param DateRange $dateRange
     * @param int $personNums
     * @return AgodaPrice
     * @throws \Exception
     */
    public function getRealTimePrice(int $hotelId, DateRange $dateRange, int $personNums): AbstractAffiliatePrice
    {
        $header = [
            'Authorization' => env('AGODA_SECRET'),
            'Content-Type'  => 'application/json'
        ];

        try {
            $response = $this->client->post(env('AGODA_API_URL'), [
                'headers' => $header,
                'json'    => [
                    'criteria' => [
                        'additional'   => [
                            'currency'     => 'TWD',
                            'discountOnly' => false,
                            'language'     => 'zh-tw',
                            'occupancy'    => [
                                'numberOfAdult' => $personNums
                            ]
                        ],
                        'checkInDate'  => $dateRange->getStartDate(),
                        'checkOutDate' => $dateRange->getEndDate(),
                        'hotelId'      => [
                            $hotelId
                        ]
                    ]
                ]
            ]);
        } catch (RequestException $e) {
            throw new \Exception($e->getMessage());
        }

        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data['results']) && ! empty($data['results'])) {
                return new AgodaPrice(Arr::first($data['results']));
            } else {
                throw new \Exception('empty');
            }
        } else {
            throw new \Exception('code error');
        }
    }
}