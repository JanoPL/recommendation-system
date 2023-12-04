<?php

namespace Recommendations\Exceptions;

use Exception;
use Recommendations\Factories\FilterStrategyFactory;

class StrategyNotDefinedException extends Exception
{
    protected $message = "You using strategy which is not defined in: " . FilterStrategyFactory::class ;
}
