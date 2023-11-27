<?php

namespace Recommendations\Strategy\Strategies;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Strategy\Interfaces\FilterStrategyInterface;

class RandomCriteriaStrategy extends BaseStrategy implements FilterStrategyInterface
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

        $count = count($this->data);
        if ($count < 3 && $count > 0) {
            return  $this->data;
        }

        $randKeys = array_rand($this->data, 3);

      return array_filter(
          $this->data,
          fn ($key) => in_array($key, $randKeys),
        ARRAY_FILTER_USE_KEY
      );
    }
}