<?php
namespace Kata\Registration\Generator;

use Kata\Registration\Generator;

/**
 * Class GeneratorTest
 * @package Kata\Registration\Generator
 */
class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * PHPUnit generate random password test
     */
    public function testRandomPassword()
    {
        $generator = new Generator();
        $stack = array();

        for ($i = 0; $i < 1000; $i++) {
            // Generate random password
            $randomPassword = $generator->randomPassword();

            // Min 8 chars
            $this->assertGreaterThanOrEqual(8, strlen($randomPassword));

            // Maximum 16 characters
            $this->assertLessThanOrEqual(16, strlen($randomPassword));

            // Password is random
            $this->assertArrayNotHasKey($randomPassword, $stack);

            $stack[$randomPassword] = true;
        }
    }
}
