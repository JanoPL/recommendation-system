<?php

namespace Recommendations\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Recommendations\RecommendStrategy;
use Recommendations\Tests\Data\Movies;
use PHPUnit\Framework\TestCase;

class RecommendStrategyTest extends TestCase
{
    protected $recommendStrategy;
    protected object $data;

    protected function setUp(): void
    {
        $this->recommendStrategy = new RecommendStrategy();
        $this->data = new Movies();
        parent::setUp();
    }

    public static function multiWords()
    {
        yield ["Skazani na Shawshank"];
        yield ["Dwunastu gniewnych ludzi"];
        yield ["Fight Club"];
        yield ["Forrest Gump"];
        yield ["Chłopaki nie płaczą"];
    }

    public static function EvenWords()
    {
        yield ["Wielki Gatsby"];
        yield ["Whiplash"];
        yield ["Władca Pierścieni: Drużyna Pierścienia"];
    }

    #[DataProvider('multiWords')]
    public function testMultiWordsCriteria($needle)
    {
        $actual = $this->recommendStrategy->multiWordsCriteria($this->data->movies);

        $this->assertContains($needle, $actual);
    }

    public function testSeasonNumberCriteria()
    {
        $this->markTestSkipped("not implemented yet");
    }

    #[DataProvider('EvenWords')]
    public function testMultiEvenWCriteria($needle)
    {
        $actual = $this->recommendStrategy->multiEvenWCriteria($this->data->movies);

        $this->assertContains($needle, $actual);
    }

    public function testRandomize()
    {
        $actual = $this->recommendStrategy->randomize($this->data->movies);

        $this->assertCount(3, $actual);
    }

    public function testGenreCriteria()
    {
        $this->markTestSkipped("not implemented yet");
    }
}
