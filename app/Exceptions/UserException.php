<?php

namespace App\Exceptions;

class UserException extends \Exception
{
    const DENIED = "provider denied request";
}