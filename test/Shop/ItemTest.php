<?php

namespace Kata\Shop\Item;

use Kata\Shop\Item;
use Kata\Shop\Product;

/*
 * @TODO
 * - test with extremities, e.g. empty item or invalid data
 */

/**
 * Class ItemTest
 * @package Kata\Shop\Item
 */
class ItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test get price
     *
     * @param $result
     * @param $name
     * @param $price
     * @param $unit
     * @param $quantity
     * @dataProvider getPriceDataProvider
     */
    public function testGetPrice($result, $name, $price, $unit, $quantity)
    {
        $product = new Product($name, $price, $unit);
        $item = new Item($product, $quantity);
        $this->assertEquals($result, $item->getPrice());
    }

    public function getPriceDataProvider()
    {
        return array(
            array(64, 'Apple', 32, 'kg', 2)
        );
    }
}