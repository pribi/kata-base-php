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
            array(42, "1,2,3,4,5,6,7,8,6")
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
}
