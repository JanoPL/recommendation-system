<?php

namespace Recommendations\Strategy\Strategies;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Strategy\Interfaces\FilterStrategyInterface;

class GenreStrategy extends BaseStrategy implements FilterStrategyInterface
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
            if (method_exists(get_class($item), 'getGenre')) {
                return $item;
            }

            return null;
        }, ARRAY_FILTER_USE_BOTH);
    }
}
