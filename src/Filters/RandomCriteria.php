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

        $randKeys = array_rand($data, 3);

        return array_unique(
            array_filter(
                $data,
                fn ($key) => in_array($key, $randKeys),
                ARRAY_FILTER_USE_KEY
            )
        );
    }
}
