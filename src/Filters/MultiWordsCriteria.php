<?php

namespace Recommendations\Filters;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Interfaces\RecommendationsInterface;

class MultiWordsCriteria extends BaseCriteria implements RecommendationsInterface
{
    /**
     * @throws ArrayEmptyException
     */
    public function filter($data): array
    {
        if (empty($data)) {
            throw new ArrayEmptyException();
        }

        return array_filter($this->removedSpecialChar($data), function ($item) {
            $check = str_word_count($item);

            if ($check > 1) {
                return $item;
            }

            return false;
        }, ARRAY_FILTER_USE_BOTH);
    }
}
