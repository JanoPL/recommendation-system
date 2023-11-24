<?php

namespace Recommendations\Strategy\Strategies;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Strategy\Interfaces\FilterStrategyInterface;

class SeasonsNumberStrategy extends BaseStrategy implements FilterStrategyInterface
{

    /**
     * @throws ArrayEmptyException
     */
    public function filter(): array
    {
        if (empty($this->data)) {
            throw new ArrayEmptyException();
        }

        return [];
    }
}