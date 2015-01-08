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
     *
     * @throws \Exception
     */
    public function add($numberString)
    {
        if (!is_string($numberString)) {
            throw new \Exception('Input is not a string');
        }

        $summary = 0;

        $numberString = str_replace("\n", self::NUMBER_DELIMITER, $numberString);

        $numberArray = explode(self::NUMBER_DELIMITER, $numberString);
        if (!empty($numberArray)) {
            foreach ($numberArray as $number) {
                $summary += intval($number);
            }
        }

        return $summary;
    }
}
