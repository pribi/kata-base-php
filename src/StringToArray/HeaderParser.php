<?php
namespace Kata\StringToArray;

/**
 * Class HeaderParser
 */
class HeaderParser
{
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

}
