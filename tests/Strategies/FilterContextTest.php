<?php

namespace Recommendations\Tests\Strategies;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Recommendations\Factories\FilterStrategyFactory;
use Recommendations\Strategy\Context;
use Recommendations\StrategyEnum;
use Recommendations\Tests\Data\Movies;

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

        $context = new Context();
        $context->addStrategy($factory->createStrategy(StrategyEnum::Random, $this->data->movies));

        $actual = $context->filter();

        $this->assertCount(3, $actual);
    }

    #[DataProvider('evenWMovies')]
    public function test_return_item_started_w($needle): void
    {
        $factory = FilterStrategyFactory::getInstance();
        $context = new Context();
        $context->addStrategy($factory->createStrategy(StrategyEnum::WCriteria, $this->data->movies));

        $actual = $context->filter();

        $this->assertContains($needle, $actual);
    }

    #[DataProvider('evenWMovies')]
    public function test_return_item_with_even_characters($needle): void
    {
        $factory = FilterStrategyFactory::getInstance();

        $context = new Context();
        $context->addStrategy($factory->createStrategy(StrategyEnum::Even, $this->data->movies));
        $actual = $context->filter();

        $this->assertContains($needle, $actual);
    }

    #[DataProvider('multiWordsMovies')]
    public function test_item_with_included_words_greater_than_1($needle): void
    {
        $factory = FilterStrategyFactory::getInstance();

        $context = new Context();
        $context->addStrategy($factory->createStrategy(StrategyEnum::MultiWords, $this->data->movies));
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