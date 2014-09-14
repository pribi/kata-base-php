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
            array(-2, array(6, 9, 15, -2, 92, 11))
        );
    }

    /**
     * Max data provider
     * @return array
     */
    public function maxDataProvider()
    {
        return array(
            array(92, array(6, 9, 15, -2, 92, 11))
        );
    }

    /**
     * Count data provider
     * @return array
     */
    public function countDataProvider()
    {
        return array(
            array(6, array(6, 9, 15, -2, 92, 11))
        );
    }

    /**
     * Max data provider
     * @return array
     */
    public function averageDataProvider()
    {
        return array(
            array(21.833333, array(6, 9, 15, -2, 92, 11))
        );
    }
}
