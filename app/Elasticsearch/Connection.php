<?php

namespace App\Elasticsearch;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class Connection
{
    private $client = null;
    private $hosts;

    /**
     * Connection constructor.
     * @param null $hosts
     * @throws \Exception
     */
    public function __construct($hosts = null)
    {
        $this->hosts = $hosts;
        $this->createClient();
    }

    /**
     * @throws \Exception
     */
    private function createClient()
    {
        $hosts = [];

        if (is_null($this->hosts)) {
            $hosts[] = '127.0.0.1';
        }

        if (is_string($this->hosts)) {
            $hosts[] = $this->hosts;
        }

        if (is_array($this->hosts)) {
            $hosts = $this->hosts;
        }

//        foreach ($hosts as $key => $host) {
//            if ( ! filter_var($host, FILTER_VALIDATE_IP) && $host !== 'localhost') {
//                unset($hosts[$key]);
//            }
//        }

        if (empty($hosts)) {
            throw new \Exception('Hosts error');
        }

        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }
}