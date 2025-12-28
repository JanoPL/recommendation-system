<?php // phpcs:ignore PSR1.Methods.CamelCapsMethodName

namespace Recommendations\Tests\Filters;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Filters\WCriteria;
use PHPUnit\Framework\TestCase;

class WCriteriaTest extends TestCase
{
    protected WCriteria $criteria;

    protected array $testData = [
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

    /**
     * @throws ArrayEmptyException
     */
    public function test_return_elements_start_with_w(): void
    {
        $actual = $this->criteria->filter($this->testData);

        $this->assertContains("westword", $actual);
        $this->assertContains("West word", $actual);
    }
}
