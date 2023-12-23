<?php

namespace Recommendations\Strategy;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Strategy\interfaces\FilterStrategyInterface;

class Context
{
    private array $strategies;

    public function __construct()
    {
    }

    public function addStrategy(FilterStrategyInterface $strategy): self
    {
        $this->strategies[] = $strategy;
        return $this;
    }

    public function filter(): array
    {
        $results = [];
        foreach ($this->strategies as $strategy) {
            if (empty($results)) {
                $results = $strategy->filter();
            } else {
                $results = $strategy->filter($results);
            }
        }

        return $results;
    }
}
