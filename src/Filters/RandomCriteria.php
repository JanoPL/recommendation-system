<?php

namespace Recommendations\Filters;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Interfaces\RecommendationsInterface;

class RandomCriteria extends BaseCriteria implements RecommendationsInterface
{

    /**
     * @throws ArrayEmptyException
     */
    public function filter(array $data): array
    {
        if (empty($data)) {
            throw new ArrayEmptyException();
        }

        $randKey = array_rand($data, 3);

        return array_filter($data, function ($item, $key) use ($randKey) {
            if (isset($randKey[$key])) {
                return $item;
            }

            return false;
        }, ARRAY_FILTER_USE_BOTH);
    }
}