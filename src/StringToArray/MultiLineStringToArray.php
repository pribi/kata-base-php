<?php
namespace Kata\StringToArray;

/**
 * Class MultiLineStringToArray
 */
class MultiLineStringToArray extends StringToArray
{
    /**
     * Header parser
     *
     * @var object
     */
    private $headerParser;

    /**
     * Sets header parser
     *
     * @param $headerParser
     */
    public function setHeaderParser($headerParser) {
        $this->headerParser = $headerParser;
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
        $lines = $this->headerParser->splitToLines($string);

        if ($this->headerParser->checkFirstLineContainsLabel($string)) {
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
}
