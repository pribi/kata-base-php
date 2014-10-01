<?php

namespace Kata\Shop;

/**
 * Class Cart
 * @package Kata\Shop
 */
class Cart {
    /**
     * Items
     *
     * @var array
     */
    private $items = array();

    /**
     * Add item to cart
     *
     * @param $item
     */
    public function add($item)
    {
        $this->items[] = $item;
    }

    /**
     * Return price
     *
     * @return float
     */
    public function getPrice()
    {
        $sum = 0;
        foreach ($this->items as $item) {
            $sum += $item->getPrice();
        }

        return $sum;
    }
} 