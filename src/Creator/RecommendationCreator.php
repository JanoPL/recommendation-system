<?php

namespace Recommendations\Creator;

use Recommendations\Interfaces\RecommendationsInterface;

abstract class RecommendationCreator
{
    /**
     * @param RecommendationsInterface $criteria
     * @param array $data
     * @return mixed
     */
    abstract protected function factoryMethod(RecommendationsInterface $criteria, array $data): mixed;

    /**
     * @param $criteria
     * @param array $data
     * @return mixed
     */
    public function doFactory($criteria, array $data): mixed
    {
        return $this->factoryMethod($criteria, $data);
    }
}
