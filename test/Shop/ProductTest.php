<?php

namespace Kata\Shop\Product;

use Kata\Shop\Product;

/*
 * @TODO
 * - test with invalid data
 */

/**
 * Class Product
 * @package Shop
 */
class ProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $result
     * @param $name
     * @param price
     * @param unit
     * @dataProvider getNameDataProvider
     */
    public function testGetName($result, $name, $price, $unit)
    {
        $product = new Product($name, $price, $unit);
        $this->assertEquals($result, $product->getName());
    }

    /**
     * @param $result
     * @param $name
     * @param price
     * @param unit
     * @dataProvider testGetPriceDataProvider
     */
    public function getPrice($result, $name, $price, $unit)
    {
        $product = new Product($name, $price, $unit);
        $this->assertEquals($result, $product->getPrice());
    }

    /**
     * @param $result
     * @param $name
     * @param price
     * @param unit
     * @dataProvider getUnitDataProvider
     */
    public function testGetUnit($result, $name, $price, $unit)
    {
        $product = new Product($name, $price, $unit);
        $this->assertEquals($result, $product->getUnit());
    }

    /**
     * testGetName data provider
     *
     * @return array
     */
    public function getNameDataProvider()
    {
        return array(
            array('Apple', 'Apple', 32, 'kg'),
            array('Light', 'Light', 15, 'year'),
            array('Starship', 'Starship', 999.99, 'piece'),
        );
    }

    /**
     * testGetPrice data provider
     *
     * @return array
     */
    public function getPriceDataProvider()
    {
        return array(
            array(32, 'Apple', 32, 'kg'),
            array(15, 'Light', 15, 'year'),
            array(999.99, 'Starship', 999.99, 'piece'),
        );
    }

    /**
     * testGetUnit data provider
     *
     * @return array
     */
    public function getUnitDataProvider()
    {
        return array(
            array('kg', 'Apple', 32, 'kg'),
            array('year', 'Light', 15, 'year'),
            array('piece', 'Starship', 999.99, 'piece'),
        );
    }
} 