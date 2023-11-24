<?php

namespace Recommendations\Tests\Strategies;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Recommendations\Exceptions\StrategyNotDefinedException;
use Recommendations\Factories\FilterStrategyFactory;
use Recommendations\Strategy\Context;
use Recommendations\Strategy\Strategies\EvenStrategy;
use Recommendations\Strategy\Strategies\GenreStrategy;
use Recommendations\Strategy\Strategies\MultiWordsStrategy;
use Recommendations\Strategy\Strategies\RandomCriteriaStrategy;
use Recommendations\Strategy\Strategies\SeasonsNumberStrategy;
use Recommendations\Strategy\Strategies\WCriteriaStrategy;
use Recommendations\Tests\Data\Movies;
use Recommendations\Tests\Data\TestStrategy;

class FilterContextTest extends TestCase
{

    protected object $data;

    public function setUp(): void
    {
        $this->data = new Movies();
    }

    public static function evenWMovies(): iterable
    {
        yield ["Whiplash"];
        yield ["Władca Pierścieni: Drużyna Pierścienia"];
    }

    public static function multiWordsMovies(): iterable
    {
        yield ["Blade Runner"];
        yield ["Wielki Gatsby"];
    }

    public static function genreMovie(): iterable
    {
        yield ['Crime'];
        yield ['Drama'];
    }

    public function test_return_random_item(): void
    {
        $factory = FilterStrategyFactory::getInstance();

        $context = new Context($factory->createStrategy("random", $this->data->movies));

        $actual = $context->filter();

        $this->assertCount(3, $actual);
    }

    public function test_strategy_exception(): void
    {
        $this->expectException(StrategyNotDefinedException::class);

        $factory = FilterStrategyFactory::getInstance();

        $context = new Context($factory->createStrategy("test", $this->data->movies), $this->data->movies);

        $factory = $context->filter();
    }

    #[DataProvider('evenWMovies')]
    public function test_return_item_started_w($needle): void
    {
        $factory = FilterStrategyFactory::getInstance();
        $context = new Context($factory->createStrategy("w_criteria", $this->data->movies));

        $actual = $context->filter();

        $this->assertContains($needle, $actual);
    }

    #[DataProvider('evenWMovies')]
    public function test_return_item_with_event_characters($needle): void
    {
        $factory = FilterStrategyFactory::getInstance();

        $context = new Context($factory->createStrategy("even", $this->data->movies));
        $actual = $context->filter();

        $this->assertContains($needle, $actual);
    }

    #[DataProvider('multiWordsMovies')]
    public function test_item_with_included_words_greater_than_1($needle): void
    {
        $factory = FilterStrategyFactory::getInstance();

        $context = new Context($factory->createStrategy("multi_words", $this->data->movies));
        $actual = $context->filter();

        $this->assertContains($needle, $actual);
    }

//    #[DataProvider('genreMovie')]
//    public function test_item_with_genre($needle): void
//    {
//        $factory = FilterStrategyFactory::getInstance();
//
//        $context = new Context($factory->createStrategy("genre", $this->data->movies));
//        $actual = $context->filter();
//
//        $this->assertContains($needle, $actual);
//    }
//
//    #[DataProvider('seasonsMovie')]
//    public function test_item_with_seasons_number($needle): void
//    {
//        $factory = FilterStrategyFactory::getInstance();
//
//        $context = new Context($factory->createStrategy("seasons_number", $this->data->movies));
//        $actual = $context->filter();
//
//        $this->assertContains($needle, $actual);
//    }
}