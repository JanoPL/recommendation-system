<?php

namespace Recommendations\Tests\Data;

use Recommendations\Strategy\interfaces\FilterStrategyInterface;
use Recommendations\Strategy\Strategies\BaseStrategy;

class TestStrategy extends BaseStrategy implements FilterStrategyInterface
{
    public function filter(): array
    {
        return ['test'];
    }
}
