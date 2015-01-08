<?php
namespace Kata\StringCalculator;

/**
 * Class StringCalculator
 * @package Kata\StringCalculator
 */
class StringCalculator
{
    const NUMBER_DELIMITER = ',';

    /**
     * Returns summary of numbers in a string
     *
     * @param string $numberString Numbers to add in a string
     *
     * @return int Summary of numbers
     */
    public function add($numberString)
    {
        $summary = 0;

        $numberArray = explode(self::NUMBER_DELIMITER, $numberString);
        if (!empty($numberArray)) {
            foreach ($numberArray as $number) {
                $summary += intval($number);
            }
        }

        return $summary;
    }
}
