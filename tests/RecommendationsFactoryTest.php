<?php

namespace Recommendations\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Recommendations\Factories\RecommendationFactory;
use Recommendations\Filters\EvenCriteria;
use Recommendations\Filters\MultiWordsCriteria;
use Recommendations\Filters\RandomCriteria;
use Recommendations\Filters\WCriteria;
use Recommendations\Tests\Data\Movies;

class RecommendationsFactoryTest extends TestCase
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

    public function test_return_random_item(): void
    {
        $factory = new RecommendationFactory();

        $actual = $factory->doFactory(new RandomCriteria(), $this->data->movies);

        $this->assertCount(3, $actual);
    }

    #[DataProvider('evenWMovies')]
    public function test_return_item_started_w($needle): void
    {
        $factory = new RecommendationFactory();

        $actual = $factory->doFactory(new WCriteria(), $this->data->movies);

        $this->assertContains($needle, $actual);
    }

    #[DataProvider('evenWMovies')]
    public function test_return_item_with_even_characters($needle): void
    {
        $factory = new RecommendationFactory();

        $actual = $factory->doFactory(new EvenCriteria(), $this->data->movies);

        $this->assertContains($needle, $actual);
    }

    #[DataProvider('multiWordsMovies')]
    public function test_item_with_included_words_greater_than_1($needle): void
    {
        $factory = new RecommendationFactory();

        $actual = $factory->doFactory(new MultiWordsCriteria(), $this->data->movies);

        $this->assertContains($needle, $actual);
    }
}