<?php

namespace Kata\Shop;

/**
 * Class Item
 * @package Kata\Shop
 */
class Item {

    /**
     * Product
     *
     * @var Product
     */
    private $product;

    /**
     * Quantity
     *
     * @var float
     */
    private $quantity;

    /**
     * Default constructor
     *
     * @param $product
     * @param $quantity
     */
    public function __construct($product, $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * Return price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->product->getPrice() * $this->quantity;
    }
} 