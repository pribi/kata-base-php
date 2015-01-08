<?php
namespace Kata\StringCalculator;

/**
 * Class StringCalculator
 * @package Kata\StringCalculator
 */
class StringCalculator
{
    const DEFAULT_NUMBER_DELIMITER = ',';

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

        $numberString = str_replace("\n", self::DEFAULT_NUMBER_DELIMITER, $numberString);

        $numberArray = explode(self::DEFAULT_NUMBER_DELIMITER, $numberString);
        if (!empty($numberArray)) {
            foreach ($numberArray as $number) {
                $summary += intval($number);
            }
        }

        return $summary;
    }

    /**
     * Returns delimiter if found in string. If delimiter not found then the default delimiter \n is returned
     *
     * @param $string
     *
     * @return string
     */
    public function findDelimiter($string) {
        $stringParts = explode("\n", $string);

        // Two parts
        if (count($stringParts) == 2) {
            if (substr($stringParts[0], 0, 2) == "//") {
                // - stringParts[0]: delimiter definition
                // - stringParts[1]: number
                return substr($stringParts[0], 2);
            }
            else {
                // No delimiter definition found in first row
                return self::DEFAULT_NUMBER_DELIMITER;
            }
        }
        else {
            // Not exactly two rows, no delimiter definition possible
            return self::DEFAULT_NUMBER_DELIMITER;
        }
    }
}
