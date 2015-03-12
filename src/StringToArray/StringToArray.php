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
     *
     * @return array
     */
    public function stringToArray($string)
    {
        return explode(',', $string);
    }
}
