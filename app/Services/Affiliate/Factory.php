<?php

namespace App\Services\Affiliate;

class Factory
{
    /**
     * @param string $affiliate
     * @return AbstractAffiliate
     * @throws \Exception
     */
    public static function make(string $affiliate): AbstractAffiliate
    {
        $affiliate = ucfirst(strtolower($affiliate));

        try {
            $reflection = new \ReflectionClass("App\Services\Affiliate\\{$affiliate}");
        } catch (\ReflectionException $e) {
            throw new \Exception('undefined');
        }

        /** @var AbstractAffiliate $object */
        $object = $reflection->newInstanceArgs();

        return $object;
    }
}
