<?php

namespace Kata\MinMax;

use Kata\MinMax;

class MinMaxTest extends \PHPUnit_Framework_TestCase
{
    public function testMin()
    {
        $minMax = new MinMax();

        $this->assertEquals(-2, $minMax->min(array(6, 9, 15, -2, 92, 11)));
    }

    public function testMax()
    {
        $minMax = new MinMax();

        $this->assertEquals(92, $minMax->max(array(6, 9, 15, -2, 92, 11)));
    }

    public function testCount()
    {
        $minMax = new MinMax();

        $this->assertEquals(6, $minMax->count(array(6, 9, 15, -2, 92, 11)));
    }

    public function testAverage()
    {
        $minMax = new MinMax();

        $this->assertEquals(21.833333, $minMax->average(array(6, 9, 15, -2, 92, 11)));
    }
}
