<?php

namespace Kata\Shop\Cart;

use Kata\Shop\Product;
use Kata\Shop\Item;
use Kata\Shop\Cart;

/**
 * Class CartTest
 * @package Kata\Shop\Cart
 */
class CartTest extends \PHPUnit_Framework_TestCase{
    /**
     * Test get price
     *
     * @param $result
     * @param $items
     * @dataProvider getPriceDataProvider
     */
    public function testGetPrice($result, $items)
    {
        $cart = new Cart();
        foreach ($items as $item) {
            $cart->add(new Item(new Product($item[0][0], $item[0][1], $item[0][2]), $item[1]));
        }

        $this->assertEquals($result, $cart->getPrice());
    }

    /**
     * Get price data provider
     *
     * @return array
     */
    public function getPriceDataProvider()
    {
        return array(
            array(
                109,
                array(
                    array(
                        array('Apple', 32, 'kg'),
                        2
                    ),
                    array(
                        array('Light', 15, 'year'),
                        3
                    )
                )
            )
        );
    }
}
