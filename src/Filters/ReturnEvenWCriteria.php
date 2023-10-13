<?php

namespace Recommendations\Filters;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Interfaces\RecommendationsInterface;

class ReturnEvenWCriteria extends BaseCriteria implements RecommendationsInterface
{
    /**
     * @throws ArrayEmptyException
     */
    public function filter($data): array
    {
        if (empty($data)) {
            throw new ArrayEmptyException();
        }

        $results = [];
        foreach ($data as $key => $item) {
            $replace = $this->removedWhiteSpaceCharFromString($item);
            $replace = $this->removedSpecialCharFromString($replace);

            $check = str_starts_with(mb_strtolower($replace), "w");

            if ($check) {
                $count = mb_strlen($replace);

                if ($count % 2 == 0) {
                    $results[] = $item;
                }
            }
        }

        return $results;
    }
}