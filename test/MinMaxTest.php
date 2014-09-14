<?php

namespace Kata\MinMax;

use Kata\MinMax;

/**
 * Class MinMaxTest
 * @package Kata\MinMax
 */
class MinMaxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests min()
     */
    public function testMin()
    {
        $minMax = new MinMax(array(6, 9, 15, -2, 92, 11));

        $this->assertEquals(-2, $minMax->min());
    }

    /**
     * Tests max()
     */
    public function testMax()
    {
        $minMax = new MinMax(array(6, 9, 15, -2, 92, 11));

        $this->assertEquals(92, $minMax->max());
    }

    /**
     * Tests count()
     */
    public function testCount()
    {
        $minMax = new MinMax(array(6, 9, 15, -2, 92, 11));

        $this->assertEquals(6, $minMax->count());
    }

    /**
     * Tests average
     */
    public function testAverage()
    {
        $minMax = new MinMax(array(6, 9, 15, -2, 92, 11));

        $this->assertEquals(21.833333, $minMax->average());
    }
}
