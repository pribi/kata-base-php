<?php

namespace Kata\Shop\Discount;

use Kata\Shop\Cart;
use Kata\Shop\Discount;
use Kata\Shop\Item;
use Kata\Shop\Product;

/*
 * @TODO
 * - test with extremities:
 *   - empty cart
 *   - empty discount
 *   - invalid data
 * - test discount price with exactly 5kgs of Apple
 * - test discount pay 2 get 3 Starships with more than 2 and less then 2 Starships
 */

/**
 * Class DiscountTest
 * @package Kata\Shop\Discount
 */
class DiscountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * PHPUnit test discount price
     */
    public function testDiscountPrice()
    {
        $product = new Product('Apple', 32, 'kg');
        $item = new Item($product, 6);
        $cart = new Cart();
        $cart->addItem($item);

        $discount = new Discount('Apple', 5, false, 25, false);
        $cart->addDiscount($discount);

        $this->assertEquals(150, $cart->getPrice());
    }

    /**
     * PHPUnit test discount price
     */
    public function testDiscountQuantity()
    {
        $product = new Product('Starship', 999.99, 'piece');
        $item = new Item($product, 2);
        $cart = new Cart();
        $cart->addItem($item);

        $discount = new Discount('Starship', 2, true, false, 3);
        $cart->addDiscount($discount);

        $this->assertEquals(3, $cart->getQuantity('Starship'));
        $this->assertEquals(1999.98, $cart->getPrice());
    }
}
