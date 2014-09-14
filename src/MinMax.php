<?php

namespace Kata;

class MinMax
{
    const PRECISION = 6;

    private $numbers;

    public function __construct(array $sequence)
    {
        $this->numbers = $sequence;
    }

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

    public function count()
    {
        $count = 0;

        foreach ($this->numbers as $number)
        {
            $count++;
        }

        return $count;
    }

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