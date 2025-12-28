<?php

namespace Recommendations\Factories;

use Exception;
use Recommendations\Exceptions\StrategyNotDefinedException;
use Recommendations\Strategy\Strategies\EvenStrategy;
use Recommendations\Strategy\Strategies\GenreStrategy;
use Recommendations\Strategy\Strategies\MultiWordsStrategy;
use Recommendations\Strategy\Strategies\RandomCriteriaStrategy;
use Recommendations\Strategy\Strategies\SeasonsNumberStrategy;
use Recommendations\Strategy\Strategies\WCriteriaStrategy;
use Recommendations\StrategyEnum;

class FilterStrategyFactory
{
    // Hold the single instance of the factory
    private static ?FilterStrategyFactory $instance = null;

    // Prevent creating a new instance of the factory
    private function __construct()
    {
    }

    // Prevent cloning the factory
    private function __clone()
    {
    }

    // Prevent unserializing the factory
    public function __wakeup()
    {
    }

    // Get the single instance of the factory
    public static function getInstance(): FilterStrategyFactory
    {
        if (self::$instance == null) {
            self::$instance = new FilterStrategyFactory();
        }

        return self::$instance;
    }

    /**
     * @param StrategyEnum $strategy
     * @param array $data
     * @return mixed
     * @throws StrategyNotDefinedException|Exception
     */
    public function createStrategy(StrategyEnum $strategy, array $data): mixed
    {
        return match ($strategy) {
            StrategyEnum::Even => new EvenStrategy($data),
            StrategyEnum::Genre => new GenreStrategy($data),
            StrategyEnum::MultiWords => new MultiWordsStrategy($data),
            StrategyEnum::Random => new RandomCriteriaStrategy($data),
            StrategyEnum::SeasonNumber => new SeasonsNumberStrategy($data),
            StrategyEnum::WCriteria => new WCriteriaStrategy($data),
            StrategyEnum::All => throw new Exception('To be implemented'),
        };
    }
}
