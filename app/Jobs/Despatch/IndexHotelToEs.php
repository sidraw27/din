<?php

namespace App\Jobs;

use App\Elasticsearch\HotelEs;
use App\Repositories\HotelRepository;
use App\Services\HotelService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class IndexHotelToEs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $hotelId;
    /** @var $hotelService HotelService */
    private $hotelService;
    /** @var $hotelRepo HotelRepository  */
    private $hotelRepo;
    /** @var $hotelEs HotelEs */
    private $hotelEs;

    /**
     * Create a new job instance.
     *
     * @param int $hotelId
     */
    public function __construct(int $hotelId)
    {
        $this->hotelId   = $hotelId;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \App\Exceptions\HotelException
     */
    public function handle()
    {
        $this->init();

        $hotel = $this->hotelRepo->getById($this->hotelId, ['url_id']);
        $hotel = $this->hotelService->getHotel($hotel->getAttribute('url_id'));

        $geo = [
            'lat' => $hotel['location']['geo']['lat'] ?? null,
            'lon' => $hotel['location']['geo']['lng'] ?? null
        ];

        foreach ($geo as $value) {
            if (is_null($value)) {
                $geo = null;
            }
        }

        $this->hotelEs->index([
            'name'            => $hotel['name'],
            'translated_name' => $hotel['translated_name'],
            'address'         => $hotel['address'],
            'geo'             => $geo,
        ], $hotel['id']);
    }

    public function init()
    {
        $this->hotelRepo = \App::make(HotelRepository::class);
        $this->hotelService = \App::make(HotelService::class);
        $this->hotelEs   = \App::make(HotelEs::class);
    }
}
