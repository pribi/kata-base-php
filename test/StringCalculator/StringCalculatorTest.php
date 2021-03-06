<?php
namespace Kata\StringCalculator;

/**
 * Class StringCalculatorTest
 * @package Kata\StringCalculator
 */
class StringCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * PHPUnit add test
     *
     * @param int $expectedSum Expected summary
     * @param string $numbers  Numbers in string format
     *
     * @dataProvider addDataProvider
     */
    public function testAdd($expectedSum, $numbers)
    {
        $stringCalculator = new StringCalculator();

        $this->assertSame($expectedSum, $stringCalculator->add($numbers));
    }

    /**
     * Data provider for add test
     *
     * @return array
     */
    public function addDataProvider()
    {
        return array(
            array(0, ""),
            array(1, "1"),
            array(3, "1,2"),
            array(6, "1,2,3"),
            array(5, "1,,4"),
            array(42, "1,2,3,4,5,6,7,8,6"),
            array(6, "1\n2,3"),
            array(6, "1,2,\n,3"),
            array(3, "//;\n1;2"),
            array(3, "//::\n1::2"),
            array(3, "//\n1,2"),
            array(4, "//:\n1:2\n3"),
            array(10, "//%0A\n1\n2\n3\n4"),
            array(2, "2,1001"),
            array(2, "1001,2"),
            array(1002, "2,1000"),
            array(1002, "1000,2"),
            array(2, "2,3451151"),
            array(2, "5123523,2"),
        );
    }

    /**
     * PHPUnit add with invalid input will throw exception
     *
     * @param string $numbers  Numbers in string format
     *
     * @dataProvider invalidInputDataProvider
     *
     * @expectedException \Exception
     */
    public function testAddWithInvalidInputWillThrowException($numbers)
    {
        $stringCalculator = new StringCalculator();
        $stringCalculator->add($numbers);
    }

    /**
     * Data provider for add with invalid input test
     *
     * @return array
     */
    public function invalidInputDataProvider()
    {
        return array(
            array(null),
            array(false),
            array(true),
            array(0),
            array(1),
            array(array()),
        );
    }

    /**
     * PHPUnit add with negative number will throw exception
     *
     * @param string $numbers  Numbers in string format
     *
     * @dataProvider negativeNumberDataProvider
     *
     * @expectedException \Exception
     * @expectedExceptionMessage negatives not allowed -1
     */
    public function testAddWithNegativeNumberWillThrowException($numbers)
    {
        $stringCalculator = new StringCalculator();
        $stringCalculator->add($numbers);
    }

    /**
     * Data provider for add with negative number test
     *
     * @return array
     */
    public function negativeNumberDataProvider()
    {
        return array(
            array("-1"),
            array("1,-1,1"),
        );
    }

    /**
     * PHPUnit add with negative numbers will throw exception
     *
     * @param string $numbers  Numbers in string format
     *
     * @dataProvider negativeNumbersDataProvider
     *
     * @expectedException \Exception
     * @expectedExceptionMessage negatives not allowed -1 -2
     */
    public function testAddWithNegativeNumbersWillThrowException($numbers)
    {
        $stringCalculator = new StringCalculator();
        $stringCalculator->add($numbers);
    }

    /**
     * Data provider for add with negative number test
     *
     * @return array
     */
    public function negativeNumbersDataProvider()
    {
        return array(
            array("-1,-2"),
            array("1,-1,2,-2"),
        );
    }

    /**
     * PHPUnit find delimiter test
     *
     * @param string $expectedDelimiter Expected delimiter
     * @param string $string            String
     *
     * @dataProvider findDelimiterDataProvider
     */
    public function testFindDelimiter($expectedDelimiter, $string)
    {
        $stringCalculator = new StringCalculator();
        $this->assertSame($expectedDelimiter, $stringCalculator->findDelimiter($string));
    }

    public function findDelimiterDataProvider()
    {
        return array(
            array(",", ""),
            array(",", "1"),
            array(",", "1;2;3"),
            array(";", "//;\n1;2"),
            array("::", "//::\n1::2"),
            array(",", "//\n12"),
            array("\n", "//%0A\n12"),
        );
    }
}
