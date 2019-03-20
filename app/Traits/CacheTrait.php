<?php

namespace App\Traits;

use Cache;
use Closure;

trait CacheTrait
{
    private $cachePrefix = '';
    private $ttl = 1440;

    protected function setPrefix(string $prefix)
    {
        $this->cachePrefix = $prefix;
    }

    protected function setTTL(int $time)
    {
        $this->ttl = abs($time);
    }

    protected function cache($key, Closure $callback, array $tags = [])
    {
        $key = $this->cachePrefix . $key;

        if (env('APP_ENV') === 'local') {
            return $callback();
        }

        if (empty($tags)) {
            $cache = Cache::get($key);
        } else {
            $cache = Cache::tags($tags)->get($key);
        }

        if (is_null($cache)) {
            $data = $callback();

            if (is_array($data) && ! empty($data) ||
                is_object($data) && ! empty((array) $data) ||
                is_numeric($data) && isset($data) ||
                is_bool($data) && isset($data)) {
                if ($this->ttl > 0)  {
                    if (empty($tags)) {
                        Cache::put($key, $data, $this->ttl);
                    } else {
                        Cache::tags($tags)->put($key, $data, $this->ttl);
                    }
                } else if ($this->ttl === 0) {
                    if (empty($tags)) {
                        Cache::forever($key, $data);
                    } else {
                        Cache::tags($tags)->forever($key, $data);
                    }
                }
                $cache = $data;
            } else {
                if (is_array($data)) return [];
                if (is_object($data)) return (object) [];
                if (is_numeric($data)) return 0;
            }
        }

        return $cache;
    }

    protected function cacheClear($key, $prefix = null, $tags = [])
    {
        if ($prefix === null) {
            $prefix = $this->cachePrefix;
        }

        $key = $prefix . $key;

        if (empty($tags)) {
            Cache::forget($key);
        } else {
            Cache::tags($tags)->flush();
        }
    }
}
