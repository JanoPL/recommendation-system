<?php

namespace Recommendations;

use Recommendations\Exceptions\StrategyNotDefinedException;
use Recommendations\Factories\FilterStrategyFactory;
use Recommendations\Strategy\Context;

class RecommendStrategy
{
    protected FilterStrategyFactory $factory;

    public function __construct()
    {
        $this->factory = FilterStrategyFactory::getInstance();
    }

    /**
     * @throws StrategyNotDefinedException
     */
    public function randomize($data): array
    {
        $context = new Context();
        $context->addStrategy($this->factory->createStrategy(strategy: StrategyEnum::Random, data: $data));
        return $context->filter();
    }

    public function multiEvenWCriteria($data): array
    {
        $context = new Context();
        $context->addStrategy($this->factory->createStrategy(strategy: StrategyEnum::Even, data: $data));
        $context->addStrategy($this->factory->createStrategy(strategy: StrategyEnum::WCriteria, data: $data));
        return  $context->filter();
    }

    public function multiWordsCriteria($data): array
    {
        $context = new Context();
        $context->addStrategy($this->factory->createStrategy(strategy: StrategyEnum::MultiWords, data: $data));
        return $context->filter();
    }

    public function genreCriteria($data): array
    {
        $context = new Context();
        $context->addStrategy($this->factory->createStrategy(strategy: StrategyEnum::Genre, data: $data));
        return $context->filter();
    }

    public function seasonNumberCriteria($data): array
    {
        $context = new Context();
        $context->addStrategy($this->factory->createStrategy(strategy: StrategyEnum::SeasonNumber, data: $data));
        return $context->filter();
    }
}
