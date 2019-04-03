<?php

namespace App\Services\Affiliate;

abstract class AbstractAffiliatePrice implements AffiliatePriceInterface
{
    protected $provider   = null;
    protected $price      = null;
    protected $roomType   = null;
    protected $landingUrl = null;
    protected $extra      = [];

    public function __construct(array $attributes)
    {
        $this->fill($attributes);
    }

    abstract protected function fill(array $attributes);
    abstract protected function setProvider(): string ;
    abstract protected function setRoomType(string $name): string ;
    abstract protected function setPrice(float $price): int ;
    abstract protected function setLandingUrl(string $url): string ;

    public function get(string $key = null): array
    {
        $result = [
            'provider'   => $this->provider,
            'price'      => $this->price,
            'roomType'   => $this->roomType,
            'landingUrl' => $this->landingUrl,
            'extra'      => $this->extra
        ];

        if (is_null($key)) {
            return $result;
        }

        if (isset($result[$key])) {
            return $result[$key];
        }

        return null;
    }
}