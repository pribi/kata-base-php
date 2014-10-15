<?php

namespace Kata\AntiBruteForce\VelocityChecker;

use Kata\AntiBruteForce\VelocityChecker;
use Kata\AntiBruteForce\Counter;

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
     * @param array $loginAttempt Current login attempt
     * @param array $failedLogins Previous failed login attempts
     *
     * @dataProvider useCaptchaDataProvider
     */
    public function testUseCaptcha($result, $loginAttempt, $failedLogins)
    {
        $counter = new Counter();
        $counter->logFailedLoginAttempts($failedLogins);
        $velocityChecker = new VelocityChecker();
        $this->assertEquals($result, $velocityChecker->useCaptcha($loginAttempt, $counter));
    }

    /**
     * Data provider for use captcha test
     *
     * @return array
     */
    public function useCaptchaDataProvider()
    {
        return array(
            array(
                false,
                array(
                    'ip' => '192.168.0.1',
                    'ip_country' => 'US',
                    'username' => 'bill',
                ),
                array(
                    array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
                    array('ip' => '192.168.0.2', 'ip_country' => 'US', 'username' => 'bill'),
                )
            )
        );
    }
}
