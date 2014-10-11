<?php

namespace Kata\AntiBruteForce\VelocityChecker;

use Kata\AntiBruteForce\VelocityChecker;

/**
 * Class VelocityCheckerTest
 *
 * @package kata\AntiBruteForce
 *
 * @author Janos Pribelszki
 */
class VelocityCheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * PHPUnit use captcha test
     *
     * @param bool $result Captcha required or not
     *
     * @dataProvider useCaptchaDataProvider
     */
    public function testUseCaptcha($result)
    {
        $velocityChecker = new VelocityChecker();
        $this->assertEquals($result, $velocityChecker->useCaptcha());
    }

    /**
     * Data provider for use captcha test
     *
     * @return array
     */
    public function useCaptchaDataProvider()
    {
        return array(
            array(false)
        );
    }
}
