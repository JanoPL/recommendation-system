<?php

namespace Recommendations\Strategy\Strategies;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Strategy\Interfaces\FilterStrategyInterface;

class RandomCriteriaStrategy extends BaseStrategy implements FilterStrategyInterface
{

    /**
     * @throws ArrayEmptyException
     */
    public function filter(): array
    {
        if (empty($this->data)) {
            throw new ArrayEmptyException();
        }

        $randKeys = array_rand($this->data, 3);

        return array_unique(
            array_filter(
                $this->data,
                fn ($key) => in_array($key, $randKeys),
                ARRAY_FILTER_USE_KEY
            )
        );
    }
}