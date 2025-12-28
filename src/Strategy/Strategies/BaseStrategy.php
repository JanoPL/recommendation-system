<?php

namespace Recommendations\Strategy\Strategies;

use Recommendations\Filters\BaseCriteria;

abstract class BaseStrategy extends BaseCriteria
{
    public ?array $data;

    public function __construct(?array $data = null)
    {
        $this->data = $data;
    }
}
