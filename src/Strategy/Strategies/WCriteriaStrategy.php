<?php

namespace Recommendations\Strategy\Strategies;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Strategy\Interfaces\FilterStrategyInterface;

class WCriteriaStrategy extends BaseStrategy implements FilterStrategyInterface
{
    /**
     * @param array $data
     * @return array
     * @throws ArrayEmptyException
     */
    public function filter(array $data = []): array
    {
        if (empty($this->data)) {
            throw new ArrayEmptyException();
        }

        return array_filter(
            $this->data,
            function ($item) {
                $replace = $this->removedSpecialCharFromString($item->getName());
                $replace = $this->removedWhiteSpaceCharFromString($replace);

                $check = str_starts_with(mb_strtolower($replace), "w");

                if ($check) {
                    return $item;
                }

                return false;
            },
            ARRAY_FILTER_USE_BOTH
        );
    }
}
