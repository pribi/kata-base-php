<?php

namespace Kata\Shop;


class Discount
{
    /**
     * Minimum quantity condition.
     *
     * @var float
     */
    private $minimumQuantity;

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
     * @param $minimumQuantity
     * @param $strict
     * @param $newPrice
     * @param $newQuantity
     */
    public function __construct($name, $minimumQuantity, $strict, $newPrice = false, $newQuantity = false)
    {
        $this->name = $name;
        $this->minimumQuantity = $minimumQuantity;
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
    public function getMinimumQuantity()
    {
        return $this->minimumQuantity;
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
