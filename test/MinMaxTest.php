<?php

namespace Kata\MinMax;

use Kata\MinMax;

class MinMaxTest extends \PHPUnit_Framework_TestCase
{
    public function testMin()
    {
        $minMax = new MinMax(array(6, 9, 15, -2, 92, 11));

        $this->assertEquals(-2, $minMax->min());
    }

    public function testMax()
    {
        $minMax = new MinMax(array(6, 9, 15, -2, 92, 11));

        $this->assertEquals(92, $minMax->max());
    }

    public function testCount()
    {
        $minMax = new MinMax(array(6, 9, 15, -2, 92, 11));

        $this->assertEquals(6, $minMax->count());
    }

    public function testAverage()
    {
        $minMax = new MinMax(array(6, 9, 15, -2, 92, 11));

        $this->assertEquals(21.833333, $minMax->average());
    }
}
