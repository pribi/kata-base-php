<?php

namespace Kata\Shop;


class Discount
{
    /**
     * Minimum quantity condition.
     *
     * @var float
     */
    private $quantity;

    /**
     * Strict rule means quantity must exceed minimum quantity
     *
     * @var
     */
    private $strict;

    /**
     * Discount price
     *
     * @var float
     */
    private $newPrice;

    /**
     * New quantity, e.g. if you buy 2 starships you get 1 for free (pay 2 get 3)
     *
     * @var float
     */
    private $newQuantity;

    /**
     * Default constructor
     *
     * @param $name
     * @param $quantity
     * @param $strict
     * @param $newPrice
     * @param $newQuantity
     */
    public function __construct($name, $quantity, $strict, $newPrice = false, $newQuantity = false)
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->strict = $strict;
        $this->newPrice = $newPrice;
        $this->newQuantity = $newQuantity;
    }

    /**
     * Return name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return minimum quantity
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Return strict
     *
     * @return mixed
     */
    public function getStrict()
    {
        return $this->strict;
    }

    /**
     * Return new price
     *
     * @return bool|float
     */
    public function getNewPrice()
    {
        return $this->newPrice;
    }

    /**
     * Return new quantity
     *
     * @return bool|float
     */
    public function getNewQuantity()
    {
        return $this->newQuantity;
    }
}
