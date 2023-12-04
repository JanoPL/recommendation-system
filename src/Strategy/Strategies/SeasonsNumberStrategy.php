<?php

namespace Recommendations\Strategy\Strategies;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Strategy\Interfaces\FilterStrategyInterface;

class SeasonsNumberStrategy extends BaseStrategy implements FilterStrategyInterface
{
    /**
     * @param array $data
     * @return array
     * @throws ArrayEmptyException
     */
    public function filter(array $data = []): array
    {
        if (empty($this->data)) {
            $this->data = $data;
        }

        if (empty($this->data)) {
            throw new ArrayEmptyException();
        }

        return array_filter($this->data, function ($item) {
            if (method_exists(get_class($item), 'getSeasonNumber')) {
                return $item;
            }

            return false;
        }, ARRAY_FILTER_USE_BOTH);
    }
}
