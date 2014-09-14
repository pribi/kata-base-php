<?php

namespace Kata;

/**
 * Class MinMax
 * @package Kata
 */
class MinMax
{
    /**
     * Floating-point precision
     */
    const PRECISION = 6;

    /**
     * @var array
     */
    private $numbers;

    /**
     * Default constructor
     *
     * @param array $sequence   An array of numbers
     */
    public function __construct(array $sequence)
    {
        $this->numbers = $sequence;
    }

    /**
     * Returns minimum value of elements
     *
     * @return int   Minimum value of elements
     */
    public function min()
    {
        $min = 0;

        foreach ($this->numbers as $number)
        {
            if ($number < $min)
            {
                $min = $number;
            }
        }

        return $min;
    }

    /**
     * Returns maximum value of elements
     *
     * @return int   Maximum value of elements
     */
    public function max()
    {
        $max = 0;

        foreach ($this->numbers as $number)
        {
            if ($number > $max)
            {
                $max = $number;
            }
        }

        return $max;
    }

    /**
     * Returns number of elements
     *
     * @return int   Number of elements
     */
    public function count()
    {
        $count = 0;

        foreach ($this->numbers as $number)
        {
            $count++;
        }

        return $count;
    }

    /**
     * Returns average value of elements
     *
     * @return float   Average value of elements
     */
    public function average()
    {
        $sum = 0;

        foreach ($this->numbers as $number)
        {
            $sum += $number;
        }

        return round($sum / $this->count(), self::PRECISION);
    }
}