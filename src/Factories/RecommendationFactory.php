<?php

namespace Recommendations\Factories;

use Exception;
use Recommendations\Creator\RecommendationCreator;
use Recommendations\Interfaces\RecommendationsInterface;

class RecommendationFactory extends RecommendationCreator
{
    /**
     * @param RecommendationsInterface $criteria
     * @param $data
     * @return array
     */
    protected function factoryMethod(RecommendationsInterface $criteria, $data): array
    {
        try {
            return $criteria->filter($data);
        } catch (Exception $exception) {
            if (!isset($this->logger)) {
                printf('<font style="color:red;">' . $exception->getMessage() . "</font>");
            }
        }
    }
}