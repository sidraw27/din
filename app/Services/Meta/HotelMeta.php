<?php

namespace App\Services\Meta;

class HotelMeta extends AbstractMeta
{
    private $hotel = [];

    public function setHotel(array $hotelView)
    {
        $this->hotel = $hotelView;
    }

    protected function getTitle()
    {
        return "{$this->hotel['name']['translated']} ({$this->hotel['name']['origin']})";
    }

    protected function getDescription()
    {
        $result = $this->getTitle();

        $result .= "，位於{$this->hotel['address']}";
        $result .= "是{$this->hotel['countryName']}旅遊住宿的好選擇。";

        return $result;
    }
}