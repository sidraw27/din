<?php

namespace App\Enum;

abstract class Enum
{
    static function getEnum($type = null) {
        try{
            $class = new \ReflectionClass(get_called_class());

            switch ($type) {
                case 'keys':
                    $result = array_keys($class->getConstants());
                    break;
                case 'values':
                    $result = array_values($class->getConstants());
                    break;
                default:
                    $result = $class->getConstants();
                    break;
            }

            return $result;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return [];
        }
    }
}
