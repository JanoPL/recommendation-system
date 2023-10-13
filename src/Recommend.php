<?php

namespace Recommendations;

use Recommendations\Factories\RecommendationFactory;
use Recommendations\Filters\MultiWordsCriteria;
use Recommendations\Filters\RandomCriteria;
use Recommendations\Filters\ReturnEvenWCriteria;

class Recommend
{
    protected RecommendationFactory $method;

    public function __construct()
    {
        $this->method = new RecommendationFactory();
    }

    public function randomize($data)
    {
        return $this->method->doFactory(new RandomCriteria(), $data);
    }

    public function multiEvenW($data)
    {
        return $this->method->doFactory(new ReturnEvenWCriteria(), $data);
    }

    public function multiWords($data)
    {
        return $this->method->doFactory(new MultiWordsCriteria(), $data);
    }
}