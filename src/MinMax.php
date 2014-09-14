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
        $min = null;

        foreach ($this->numbers as $number)
        {
            if (null === $min) {
                $min = $number;
            }

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
        $max = null;

        foreach ($this->numbers as $number)
        {
            if (null === $max) {
                $max = $number;
            }

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

        $count = $this->count();
        if ($count > 0) {
            return round($sum / $count, self::PRECISION);
        } else {
            return null;
        }

    }
}