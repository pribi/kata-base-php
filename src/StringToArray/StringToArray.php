<?php
namespace Kata\StringToArray;

/**
 * Class StringToArray
 */
class StringToArray
{
    /**
     * String to array method
     *
     * @param string $string String to convert to array
     * @param string $columnDelimiter     Column delimiter
     *
     * @return array
     */
    public function stringToArray($string, $columnDelimiter = ',')
    {
        return explode($columnDelimiter, $string);
    }
}
