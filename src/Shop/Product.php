<?php

namespace Kata\Shop;

/**
 * Class Product
 * @package Shop
 */
class Product
{
    /**
     * Name
     *
     * @var string
     */
    private $name;

    /**
     * Price
     *
     * @var float
     */
    private $price;

    /**
     * Unit
     *
     * @var string
     */
    private $unit;

    /**
     * Default constructor
     *
     * @param $name
     * @param $price
     * @param $unit
     */
    public function __construct($name, $price, $unit)
    {
        $this->name = $name;
        $this->price = $price;
        $this->unit = $unit;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
