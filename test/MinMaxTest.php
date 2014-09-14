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
     * @dataProvider minDataProvider
     */
    public function testMin($result, $numbers)
    {
        $minMax = new MinMax($numbers);

        $this->assertEquals($result, $minMax->min());
    }

    /**
     * Tests max()
     * @dataProvider maxDataProvider
     */
    public function testMax($result, $numbers)
    {
        $minMax = new MinMax($numbers);

        $this->assertEquals($result, $minMax->max());
    }

    /**
     * Tests count()
     * @dataProvider countDataProvider
     */
    public function testCount($result, $numbers)
    {
        $minMax = new MinMax($numbers);

        $this->assertEquals($result, $minMax->count());
    }

    /**
     * Tests average
     * @dataProvider averageDataProvider
     */
    public function testAverage($result, $numbers)
    {
        $minMax = new MinMax($numbers);

        $this->assertEquals($result, $minMax->average());
    }

    /**
     * Min data provider
     * @return array
     */
    public function minDataProvider()
    {
        return array(
            array(0, array(0)),
            array(1, array(1, 2, 3)),
            array(-3, array(-1, -2, -3)),
            array(1.41, array(1.41, 2.81, 3.14)),
            array(-2, array(6, 9, 15, -2, 92, 11)),
            array(null, array()),
        );
    }

    /**
     * Max data provider
     * @return array
     */
    public function maxDataProvider()
    {
        return array(
            array(0, array(0)),
            array(3, array(1, 2, 3)),
            array(-1, array(-1, -2, -3)),
            array(3.14, array(1.41, 2.81, 3.14)),
            array(92, array(6, 9, 15, -2, 92, 11)),
            array(null, array()),
        );
    }

    /**
     * Count data provider
     * @return array
     */
    public function countDataProvider()
    {
        return array(
            array(1, array(0)),
            array(3, array(1, 2, 3)),
            array(3, array(-1, -2, -3)),
            array(3, array(1.41, 2.81, 3.14)),
            array(6, array(6, 9, 15, -2, 92, 11)),
            array(0, array()),
        );
    }

    /**
     * Max data provider
     * @return array
     */
    public function averageDataProvider()
    {
        return array(
            array(0, array(0)),
            array(2, array(1, 2, 3)),
            array(-2, array(-1, -2, -3)),
            array(2.453333, array(1.41, 2.81, 3.14)),
            array(21.833333, array(6, 9, 15, -2, 92, 11)),
            array(null, array()),
        );
    }
}
