<?php // phpcs:ignore PSR1.Methods.CamelCapsMethodName

namespace Recommendations\Tests\Filters;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Filters\MultiWordsCriteria;
use PHPUnit\Framework\TestCase;

class MultiWordsCriteriaTest extends TestCase
{
    protected MultiWordsCriteria $criteria;

    protected array $testData = [
        'multi words test',
        'single_words_test',
        'single'
    ];

    public function setUp(): void
    {
        $this->criteria = new MultiWordsCriteria();
        parent::setUp();
    }

    /**
     * @throws ArrayEmptyException
     */
    public function test_throw_exception_if_empty_array(): void
    {
        $data = [];

        $this->expectException(ArrayEmptyException::class);

        $this->criteria->filter($data);
    }

    /**
     * @throws ArrayEmptyException
     */
    public function test_returns_elements_is_array(): void
    {
        $actual = $this->criteria->filter($this->testData);

        $this->assertIsArray($actual);
    }

    /**
     * @throws ArrayEmptyException
     */
    public function test_return_elements_greater_than_1(): void
    {
        $criteria = new MultiWordsCriteria();
        $actual = $criteria->filter($this->testData);

        $this->assertContains("multi words test", $actual);
        $this->assertCount(1, $actual);
    }
}
