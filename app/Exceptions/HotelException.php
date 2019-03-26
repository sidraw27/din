<?php

namespace App\Exceptions;

class HotelException extends \Exception
{
    const NOT_FOUND = "hotel non exists";
    const ITEM_NULL = "item is null";
}