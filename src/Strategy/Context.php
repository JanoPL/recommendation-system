<?php

namespace Recommendations\Strategy;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Strategy\interfaces\FilterStrategyInterface;

class Context
{
    private FilterStrategyInterface $strategy;

    public function __construct(FilterStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(FilterStrategyInterface $strategy): self
    {
        $this->strategy = $strategy;
        return $this;
    }

    public function filter(): array
    {
        return $this->strategy->filter();
    }
}