<?php

namespace Recommendations\Strategy\Strategies;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Strategy\Interfaces\FilterStrategyInterface;

class MultiWordsStrategy extends BaseStrategy implements FilterStrategyInterface
{

    /**
     * @param array $data
     * @throws ArrayEmptyException
     */
    public function filter(array $data = []): array
    {
        if (empty($this->data)) {
            throw new ArrayEmptyException();
        }

        return array_filter($this->removedSpecialChar($this->data), function ($item) {
            $check = str_word_count($item);

            if ($check > 1) {
                return $item;
            }

            return false;
        }, ARRAY_FILTER_USE_BOTH);
    }
}