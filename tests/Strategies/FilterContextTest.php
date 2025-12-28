<?php // phpcs:ignore PSR1.Methods.CamelCapsMethodName

namespace Recommendations\Tests\Strategies;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Recommendations\Exceptions\StrategyNotDefinedException;
use Recommendations\Factories\FilterStrategyFactory;
use Recommendations\Strategy\Context;
use Recommendations\StrategyEnum;
use Recommendations\Tests\Data\Movie;
use Recommendations\Tests\Data\MoviesExtend;
use Recommendations\Tests\Data\Series;

class FilterContextTest extends TestCase
{
    protected object $data;

    public function setUp(): void
    {
        $this->data = new MoviesExtend();
    }

    private static function createMovie(string $name): Movie
    {
        $movie = new Movie();
        $movie->setName($name);
        $movie->setGenre('test');

        return $movie;
    }

    private static function createSeries(string $name): Series
    {
        $series = new Series();
        $series->setName($name);
        $series->setSeasonNumber(1);

        return $series;
    }

    public static function multiWordsSeries(): iterable
    {
        yield [self::createSeries('Luke Cage')];
        yield [self::createSeries("Game of Thrones")];
    }

    public static function evenWMovies(): iterable
    {
        yield [self::createMovie("Whiplash")];
        yield [self::createMovie("Władca Pierścieni: Drużyna Pierścienia")];
    }

    public static function multiWordsMovies(): iterable
    {
        yield [self::createMovie("Blade Runner")];
        yield [self::createMovie("Wielki Gatsby")];
    }

    /**
     * @throws StrategyNotDefinedException
     */
    public function test_return_random_item(): void
    {
        $factory = FilterStrategyFactory::getInstance();

        $context = new Context();
        $context->addStrategy($factory->createStrategy(StrategyEnum::Random, $this->data->movies));

        $actual = $context->filter();

        $this->assertCount(3, $actual);
    }

    /**
     * @throws StrategyNotDefinedException
     */
    #[DataProvider('evenWMovies')]
    public function test_return_item_started_w($needle): void
    {
        $factory = FilterStrategyFactory::getInstance();
        $context = new Context();
        $context->addStrategy($factory->createStrategy(StrategyEnum::WCriteria, $this->data->movies));

        $actual = $context->filter();

        $this->assertContainsEquals($needle, $actual);
    }

    /**
     * @throws StrategyNotDefinedException
     */
    #[DataProvider('evenWMovies')]
    public function test_return_item_with_even_characters($needle): void
    {
        $factory = FilterStrategyFactory::getInstance();

        $context = new Context();
        $context->addStrategy($factory->createStrategy(StrategyEnum::Even, $this->data->movies));
        $actual = $context->filter();

        $this->assertContainsEquals($needle, $actual);
    }

    /**
     * @throws StrategyNotDefinedException
     */
    #[DataProvider('multiWordsMovies')]
    public function test_item_with_included_words_greater_than_1($needle): void
    {
        $factory = FilterStrategyFactory::getInstance();

        $context = new Context();
        $context->addStrategy($factory->createStrategy(StrategyEnum::MultiWords, $this->data->movies));
        $actual = $context->filter();

        $this->assertContainsEquals($needle, $actual);
    }

    /**
     * @throws StrategyNotDefinedException
     */
    #[DataProvider('multiWordsMovies')]
    public function test_item_with_genre($needle): void
    {
        $factory = FilterStrategyFactory::getInstance();

        $context = new Context();
        $context->addStrategy($factory->createStrategy(StrategyEnum::Genre, $this->data->movies));
        $actual = $context->filter();

        $this->assertContainsEquals($needle, $actual);
    }

    /**
     * @throws StrategyNotDefinedException
     */
    #[DataProvider('multiWordsSeries')]
    public function test_item_with_seasons_number($needle): void
    {
        $factory = FilterStrategyFactory::getInstance();

        $context = new Context();
        $context->addStrategy($factory->createStrategy(StrategyEnum::SeasonNumber, $this->data->movies));
        $actual = $context->filter();

        $this->assertContainsEquals($needle, $actual);
    }
}
