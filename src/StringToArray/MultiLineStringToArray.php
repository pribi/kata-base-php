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
        $lines = $this->splitToLines($string);

        if ($lines[0] === '#useFirstLineAsLabels') {
            $returnValue = new \StdClass();
            $returnValue->labels = parent::stringToArray($lines[1]);
            $data = array();

            $num = 0;
            foreach ($lines as $line) {
                if ($num++ < 2) {
                    continue;
                }

                $data[] = parent::stringToArray($line);
            }

            $returnValue->data = $data;
        }
        else {
            $returnValue = array();

            foreach ($lines as $line) {
                $returnValue[] = parent::stringToArray($line);
            }
        }

        return $returnValue;
    }
}
