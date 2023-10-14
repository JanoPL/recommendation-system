<?php

namespace Recommendations\Filters;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Interfaces\RecommendationsInterface;

class EvenCriteria extends BaseCriteria implements RecommendationsInterface
{

    public function filter(array $data): array
    {
        if (empty($data)) {
            throw new ArrayEmptyException();
        }


        return array_filter($data, function ($item) {
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