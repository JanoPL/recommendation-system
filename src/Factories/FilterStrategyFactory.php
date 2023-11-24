<?php

namespace Recommendations\Factories;

use Recommendations\Exceptions\StrategyNotDefinedException;
use Recommendations\Strategy\Strategies\EvenStrategy;
use Recommendations\Strategy\Strategies\GenreStrategy;
use Recommendations\Strategy\Strategies\MultiWordsStrategy;
use Recommendations\Strategy\Strategies\RandomCriteriaStrategy;
use Recommendations\Strategy\Strategies\SeasonsNumberStrategy;
use Recommendations\Strategy\Strategies\WCriteriaStrategy;

class FilterStrategyFactory
{
    // Hold the single instance of the factory
    private static $instance;

    // Prevent creating a new instance of the factory
    private function __construct()
    {
    }

    // Prevent cloning the factory
    private function __clone()
    {
    }

    // Prevent unserializing the factory
    private function __wakeup()
    {
    }

    // Get the single instance of the factory
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new FilterStrategyFactory();
        }

        return self::$instance;
    }

    /**
     * @param string $strategy even, genre, multi_words, random, season_number, w_criteria
     * @param array $data
     * @return mixed
     * @throws StrategyNotDefinedException
     */
    public function createStrategy(string $strategy, array $data): mixed
    {
        return match ($strategy) {
            "even" => new EvenStrategy($data),
            "genre" => new GenreStrategy($data),
            "multi_words" => new MultiWordsStrategy($data),
            "random" => new RandomCriteriaStrategy($data),
            "seasons_number" => new SeasonsNumberStrategy($data),
            "w_criteria" => new WCriteriaStrategy($data),
            default => throw new StrategyNotDefinedException(),
        };
    }
}