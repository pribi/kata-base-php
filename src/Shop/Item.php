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

    /**
     * Return product name
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->product->getName();
    }

    /**
     * Return quantity
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param $price
     */
    public function setPrice($price)
    {
        $this->product->setPrice($price);
    }

    /**
     * Returns name
     *
     * @return string
     */
    public function getName()
    {
        return $this->product->getName();
    }

    /**
     * return unit
     *
     * @return string
     */
    public function getProductUnit()
    {
        return $this->product->getUnit();
    }
}
