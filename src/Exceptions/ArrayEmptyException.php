<?php

namespace Recommendations\Exceptions;

use Exception;

class ArrayEmptyException extends Exception
{
    protected $message = "Array cannot be empty";
}
