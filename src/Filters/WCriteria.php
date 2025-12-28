<?php

namespace Recommendations\Filters;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Interfaces\RecommendationsInterface;

class WCriteria extends BaseCriteria implements RecommendationsInterface
{
    /**
     * @throws ArrayEmptyException
     */
    public function filter(array $data): array
    {
        if (empty($data)) {
            throw new ArrayEmptyException();
        }

        return array_filter($data, function ($item) {
            $replace = $this->removedSpecialCharFromString($item);
            $replace = $this->removedWhiteSpaceCharFromString($replace);

            $check = str_starts_with(mb_strtolower($replace), "w");

            if ($check) {
                return $item;
            }
            return false;
        }, ARRAY_FILTER_USE_BOTH);
    }
}
