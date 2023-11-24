<?php

namespace Recommendations\Strategy\Strategies;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Strategy\Interfaces\FilterStrategyInterface;

class EvenStrategy extends BaseStrategy implements FilterStrategyInterface
{
    /**
     * @throws ArrayEmptyException
     */
    public function filter(): array
    {
        if (empty($this->data)) {
            throw new ArrayEmptyException();
        }


        return array_filter($this->data, function ($item) {
            $replace = $this->removedSpecialCharFromString($item);
            $replace = $this->removedWhiteSpaceCharFromString($replace);

            $count = mb_strlen($replace);

            if ($count % 2 == 0) {
                return $item;
            }

            return false;
        }, ARRAY_FILTER_USE_BOTH);
    }
}