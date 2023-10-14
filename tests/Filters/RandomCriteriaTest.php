<?php

namespace Recommendations\Tests\Filters;

use Recommendations\Exceptions\ArrayEmptyException;
use Recommendations\Filters\RandomCriteria;
use PHPUnit\Framework\TestCase;

class RandomCriteriaTest extends TestCase
{
    protected $criteria;

    protected $testData =  [
        'test 1',
        'test 2',
        'test 3',
        'test 4',
        'test 5',
        'test 5',
    ];

    public function setUp(): void
    {
        $this->criteria = new RandomCriteria();
        parent::setUp();
    }

    public function test_throw_exception_if_empty_array(): void
    {
        $data = [];

        $this->expectException(ArrayEmptyException::class);

        $this->criteria->filter($data);
    }

    /**
     * @throws ArrayEmptyException
     */
    public function test_return_random_elements(): void
    {
        $actual = $this->criteria->filter($this->testData);

        $this->assertCount(3, $actual);
    }

    /**
     * @throws ArrayEmptyException
     */
    public function test_return_random_elements_is_no_duplicate(): void
    {
        $actual = $this->criteria->filter($this->testData);

        $this->assertCount(3, $actual);
    }
}
