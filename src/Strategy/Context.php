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
        foreach ($this->strategies as $strategy) {
            $results = $strategy->filter();
        }

        return $results;
    }
}