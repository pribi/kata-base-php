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
     *
     * @dataProvider stringToArrayDataProvider
     *
     */
    public function testStringToArray($expectedReturnValue, $string)
    {
        $stringToArray = new StringToArray();
        $this->assertSame($expectedReturnValue, $stringToArray->stringToArray($string));
    }

    /**
     * Data provider for string to array test
     *
     * @return array
     */
    public function stringToArrayDataProvider()
    {
        return  array(
            array(array('a', 'b', 'c'), "a,b,c"),
            array(array('100', '982', '444', '990', '1'), "100,982,444,990,1"),
            array(array('Mark', 'Anthony', 'marka@lib.de'), "Mark,Anthony,marka@lib.de")
        );
    }
}
