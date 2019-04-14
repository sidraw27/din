<?php

namespace App\Exceptions;

class HotelException extends \Exception
{
    const NOT_FOUND = "hotel non exists";
    const LIST_EMPTY = "search result not found";
    const ITEM_NULL = "item is null";
    const PRICE_NOT_GET = "price get fail";
    const AFFILIATE_NOT_FOUND = "affiliate not found";
}