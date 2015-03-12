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
     *
     * @return array
     */
    public function stringToArray($string)
    {
        $returnValue = array();

        $lines = $this->splitToLines($string);
        foreach ($lines as $line) {
            $returnValue[] = parent::stringToArray($line);
        }

        return $returnValue;
    }

}
