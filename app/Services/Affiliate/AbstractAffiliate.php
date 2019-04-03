<?php

namespace App\Services\Affiliate;

use GuzzleHttp\Client;

abstract class AbstractAffiliate implements AffiliateInterface
{
    /* @var $client Client */
    protected $client;

    public function __construct()
    {
        $this->client = \App::make(Client::class);
    }
}