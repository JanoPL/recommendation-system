<?php

namespace Recommendations\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Recommendations\RecommendStrategy;
use PHPUnit\Framework\TestCase;
use Recommendations\Tests\Data\Movie;
use Recommendations\Tests\Data\MoviesExtend;
use Recommendations\Tests\Data\Series;

class RecommendStrategyTest extends TestCase
{
    protected $recommendStrategy;
    protected object $data;

    protected function setUp(): void
    {
        $this->recommendStrategy = new RecommendStrategy();
        $this->data = new MoviesExtend();
        parent::setUp();
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

    public static function multiWords()
    {
        yield [self::createMovie("Skazani na Shawshank")];
        yield [self::createMovie("Dwunastu gniewnych ludzi")];
        yield [self::createMovie("Fight Club")];
        yield [self::createMovie("Forrest Gump")];
        yield [self::createMovie("Chłopaki nie płaczą")];
    }

    public static function EvenWords()
    {
        yield [self::createMovie("Wielki Gatsby")];
        yield [self::createMovie("Whiplash")];
        yield [self::createMovie("Władca Pierścieni: Drużyna Pierścienia")];
    }

    public static function series()
    {
        yield [self::createSeries("Game of Thrones")];
        yield [self::createSeries("Vikings")];
        yield [self::createSeries("Luke Cage")];
    }

    #[DataProvider('multiWords')]
    public function testMultiWordsCriteria($needle)
    {
        $actual = $this->recommendStrategy->multiWordsCriteria($this->data->movies);

        $this->assertContainsEquals($needle, $actual);
    }

    #[DataProvider('series')]
    public function testSeasonNumberCriteria($needle)
    {
        $contains = $this->recommendStrategy->SeasonNumberCriteria($this->data->movies);

        $this->assertContainsEquals($needle, $contains);
    }

    #[DataProvider('EvenWords')]
    public function testMultiEvenWCriteria($needle)
    {
        $actual = $this->recommendStrategy->multiEvenWCriteria($this->data->movies);

        $this->assertContainsEquals($needle, $actual);
    }

    public function testRandomize()
    {
        $actual = $this->recommendStrategy->randomize($this->data->movies);

        $this->assertCount(3, $actual);
    }

    #[DataProvider('multiWords')]
    public function testGenreCriteria($needle)
    {
        $actual = $this->recommendStrategy->genreCriteria($this->data->movies);

        $this->assertContainsEquals($needle, $actual);
    }

}
