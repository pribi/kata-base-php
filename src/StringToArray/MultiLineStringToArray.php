<?php
namespace Kata\StringToArray;

/**
 * Class MultiLineStringToArray
 */
class MultiLineStringToArray extends StringToArray
{
    /**
     * Split to lines method
     *
     * @param string $string String to split to lines
     *
     * @return array
     */

    public function splitToLines($string)
    {
        return explode("\n", $string);
    }

    /**
     * Multi-line string to array method
     *
     * Explodes string by new line (\n) and returns a two dimensional array
     *
     * @param string $string String to convert to array
     * @param string $columnDelimiter     Column delimiter
     *
     * @return array
     */
    public function stringToArray($string, $columnDelimiter = ',')
    {
        $lines = $this->splitToLines($string);

        if ($this->checkFirstLineContainsLabel($string)) {
            $returnValue = new \StdClass();
            $returnValue->labels = parent::stringToArray($lines[1]);

            unset($lines[0]);
            unset($lines[1]);
            $data = array();
            foreach ($lines as $line) {
                $data[] = parent::stringToArray($line, $columnDelimiter);
            }

            $returnValue->data = $data;
        }
        else {
            $returnValue = array();

            foreach ($lines as $line) {
                $returnValue[] = parent::stringToArray($line, $columnDelimiter);
            }
        }

        return $returnValue;
    }

    /**
     * Check if the string in the first line contains a label definition
     * - returns true if it contains
     * - returns false
     *
     * @param string $string String to check
     *
     * @return bool
     */
    public function checkFirstLineContainsLabel($string)
    {
        $lines = $this->splitToLines($string);

        // Less than 2 lines, not possible label definition
        if (count($lines) < 2) {
            return false;
        }

        if ($lines[0] !== '#useFirstLineAsLabels') {
            return false;
        }

        // Empty labels are no labels
        if (empty($lines[1])) {
            return false;
        }

        return true;
    }
}
