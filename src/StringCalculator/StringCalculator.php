<?php
namespace Kata\StringCalculator;
use Kata\Registration\Dao\Exception;

/**
 * Class StringCalculator
 * @package Kata\StringCalculator
 */
class StringCalculator
{
    // Default delimiter character
    const DEFAULT_NUMBER_DELIMITER = ',';

    // Maximum allowed number
    const MAXIMUM_ALLOWED_NUMBER = 1000;

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
        $negativeNumbers = "";

        // Find delimiter
        $delimiter = $this->findDelimiter($numberString);

        if ($delimiter !== self::DEFAULT_NUMBER_DELIMITER) {
            // Delimiter is defined, skip delimiter definition from string numbers
            $numberString = explode("\n", $numberString);
            $numberString = $numberString[1];
        }
        else {
            $numberString = str_replace("\n", $delimiter, $numberString);
        }

        // Calculate summary
        $numberArray = explode($delimiter, $numberString);
        if (!empty($numberArray)) {
            foreach ($numberArray as $number) {
                $intVal = intval($number);

                if ($intVal > self::MAXIMUM_ALLOWED_NUMBER) {
                    continue;
                }

                // Negative number found
                if ($intVal < 0) {
                    $negativeNumbers .= " " . $intVal;
                }
                $summary += $intVal;
            }
        }

        // Negative numbers found
        if ($negativeNumbers !== "") {
            throw new \Exception("negatives not allowed" . $negativeNumbers);
        }

        return $summary;
    }

    /**
     * Returns delimiter if found in string. If delimiter is not found then the default delimiter is returned
     *
     * @param $string
     *
     * @return string
     */
    public function findDelimiter($string) {
        // Explode string to find any delimiter
        $stringParts = explode("\n", $string);

        if (count($stringParts) == 2) {
            // Two parts
            if (substr($stringParts[0], 0, 2) == "//") {
                // - first part: possible delimiter definition
                // - second part: string numbers
                $delimiter = substr($stringParts[0], 2);
                if (false === $delimiter) {
                    // Empty character is not a valid delimiter eg. //\n
                    return self::DEFAULT_NUMBER_DELIMITER;
                } else {
                    // Delimiter can be urlencoded
                    return urldecode($delimiter);
                }
            } else {
                // No delimiter definition found in first row
                return self::DEFAULT_NUMBER_DELIMITER;
            }
        }
        else {
            // Not exactly two parts, no delimiter definition
            return self::DEFAULT_NUMBER_DELIMITER;
        }
    }
}
