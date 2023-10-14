<?php

namespace Recommendations;

use Recommendations\Factories\RecommendationFactory;
use Recommendations\Filters\EvenCriteria;
use Recommendations\Filters\MultiWordsCriteria;
use Recommendations\Filters\RandomCriteria;
use Recommendations\Filters\WCriteria;

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
        $data = $this->method->doFactory(new EvenCriteria(), $data);
        return $this->method->doFactory(new WCriteria(), $data);
    }

    public function multiWords($data)
    {
        return $this->method->doFactory(new MultiWordsCriteria(), $data);
    }
}