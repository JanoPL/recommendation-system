<?php

namespace Recommendations\Tests\Filters;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Filters\WCriteria;
use PHPUnit\Framework\TestCase;

class WCriteriaTest extends TestCase
{
    protected $criteria;

    protected $testData = [
        "West word",
        "wTest word",
        "wtest Word",
        "Test word",
        "test",
        "westword"
    ];

    public function setUp(): void
    {
        $this->criteria = new WCriteria();
        parent::setUp();
    }

    public function test_throwing_exception(): void
    {
        $data = [];

        $this->expectException(ArrayEmptyException::class);

        $this->criteria->filter($data);
    }

    public function test_return_elements_start_with_w(): void
    {
        $actual = $this->criteria->filter($this->testData);

        $this->assertContains("westword", $actual);
        $this->assertContains("West word", $actual);
    }
}
