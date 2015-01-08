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
            array(0, "")
        );
    }
}
