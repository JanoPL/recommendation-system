<?php

namespace Recommendations\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Recommendations\Recommend;
use PHPUnit\Framework\TestCase;
use Recommendations\Tests\Data\Movies;

class RecommendTest extends TestCase
{
    protected $recommend;
    protected object $data;

    public function setUp(): void
    {
        $this->recommend = new Recommend();
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
    public function testMultiWords($needle)
    {
        $actual = $this->recommend->multiWords($this->data->movies);

        $this->assertContains($needle, $actual);
    }

    public function testRandomize()
    {
        $actual = $this->recommend->randomize($this->data->movies);

        $this->assertCount(3, $actual);
    }

    #[DataProvider('EvenWords')]
    public function testMultiEvenW($needle)
    {
        $actual = $this->recommend->multiEvenW($this->data->movies);

        $this->assertContains($needle, $actual);
    }
}
