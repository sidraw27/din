<?php

namespace App\Traits;

trait HelperTrait
{
    protected function changeSubDomain(string &$link, string $subDomain)
    {
        $parseUrl = parse_url($link);
        $host     = explode('.', $parseUrl['host']);

        $link = $parseUrl['scheme'] . '://';
        if (count($host) > 2) {
            unset($host[0]);
        }
        $link .= strtolower($subDomain) . '.' . implode('.', $host);
        $link .= $parseUrl['path'];
    }
}
