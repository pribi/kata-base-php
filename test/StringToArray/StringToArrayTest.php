<?php
namespace Kata\StringToArray;

/**
 * Class StringToArray
 *
 * @package StringToArray
 */
class StringToArrayTest extends \PHPUnit_framework_TestCase
{
    /**
     * Test stringToArray method
     *
     * @param array  $expectedReturnValue Expected return value
     * @param string $string              String
     * @param string $columnDelimiter     Column delimiter
     *
     * @dataProvider stringToArrayDataProvider
     *
     */
    public function testStringToArray($expectedReturnValue, $string, $columnDelimiter = ',')
    {
        $stringToArray = new StringToArray();
        $this->assertSame($expectedReturnValue, $stringToArray->stringToArray($string, $columnDelimiter));
    }

    /**
     * Data provider for string to array test
     *
     * @return array
     */
    public function stringToArrayDataProvider()
    {
        return  array(
            array(array(''), ''),
            array(array('', '', 'asdf'), ',,asdf'),
            array(array('a', 'b', 'c'), "a,b,c"),
            array(array('100', '982', '444', '990', '1'), "100,982,444,990,1"),
            array(array('Mark', 'Anthony', 'marka@lib.de'), "Mark,Anthony,marka@lib.de"),
            array(array('', '', 'asdf'), '::asdf', ':'),
            array(array('a', 'b', 'c'), "a;b;c", ';'),
        );
    }
}
