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
    public function addItem($item)
    {
        $this->items[] = $item;
    }

    /**
     * Add discount
     *
     * @param $discount
     */
    public function addDiscount($discount)
    {
        // Discount rule condition met
        if ($discount->getStrict() && ($this->getQuantity($discount->getName()) > $discount->getQuantity())
            || !$discount->getStrict() && ($this->getQuantity($discount->getName()) >= $discount->getQuantity())) {

            // New price rule
            if (false !== $discount->getNewPrice()) {
                $this->setPrice($discount->getName(), $discount->getNewPrice());
            }

            // New quantity rule
            if (false !== $discount->getNewQuantity()) {
                $this->setNewQuantity($discount->getName(), $discount->getNewQuantity());
            }
        }
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

    /**
     * Return quantity of product name
     *
     * @param $name
     * @return int
     */
    public function getQuantity($name)
    {
        $quantity = 0;
        foreach ($this->items as $item) {
            if ($item->getProductName() == $name) {
                $quantity += $item->getQuantity();
            }
        }

        return $quantity;
    }

    /**
     * Set price
     *
     * @param $name
     * @param $price
     */
    public function setPrice($name, $price)
    {
        if (!empty($this->items)) {
            foreach ($this->items as $item) {
                if ($item->getProductName() == $name) {
                    $item->setPrice($price);
                }
            }
        }
    }

    /**
     * Set new quantity
     *
     * @param $name
     * @param $quantity
     */
    public function setNewQuantity($name, $quantity)
    {
        if ($quantity > $this->getQuantity($name)) {
            $product = new Product($name, 0, $this->getProductUnit($name));
            $item = new Item($product, $quantity - $this->getQuantity($name));
            $this->addItem($item);
        }
    }

    /**
     * Return product unit
     *
     * @param $name
     * @return mixed
     */
    public function getProductUnit($name)
    {
        foreach ($this->items as $item) {
            if ($item->getName() == $name) {
                return $item->getProductUnit();
            }
        }
    }
}
