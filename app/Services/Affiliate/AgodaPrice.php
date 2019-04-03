<?php

namespace App\Services\Affiliate;

class AgodaPrice extends AbstractAffiliatePrice
{
    protected function fill(array $attributes)
    {
        $this->provider   = $this->setProvider();
        $this->price      = $this->setPrice($attributes['dailyRate']);
        $this->roomType   = $this->setRoomType($attributes['roomtypeName']);
        $this->landingUrl = $this->setLandingUrl($attributes['landingURL']);
    }

    protected function setProvider(): string
    {
        return 'agoda';
    }

    protected function setPrice(float $price): int
    {
        return ceil($price);
    }

    protected function setRoomType(string $type): string
    {
        return $type ?? '房型未知';
    }

    protected function setLandingUrl(string $url): string
    {
        return $url;
    }
}