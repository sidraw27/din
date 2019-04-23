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

        $result .= "，位於{$this->hotel['address']}，";
        $result .= "是{$this->hotel['countryName']}旅遊住宿的好選擇，";

        $result .= "{$this->hotel['name']['translated']}是{$this->hotel['starRated']}星級飯店，";
        if ($this->hotel['starRated'] >= 0 && $this->hotel['starRated'] < 3) {
           $result .= '提供您簡易標準的住宿空間，讓您的旅程不必煩惱住宿。';
        } elseif ($this->hotel['starRated'] >= 3 && $this->hotel['starRated'] < 5) {
            $result .= '可以提供您舒適合宜的住宿環境，讓您的旅程輕鬆自在。';
        } elseif ($this->hotel['starRated'] === 5) {
            $result .= '其高標準的環境及提供的服務保證令您賓至如歸。';
        }

        return $result;
    }
}