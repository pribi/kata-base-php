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
     * @param bool $result        Is captcha required
     * @param array $loginAttempt Current login attempt
     * @param array $failedLogins Previous failed login attempts
     *
     * @dataProvider useCaptchaDataProvider
     */
    public function testUseCaptcha($result, $loginAttempt, $failedLogins)
    {
        $counter = new Counter();
        $counter->logFailedLogins($failedLogins);
        $velocityChecker = new VelocityChecker();
        $this->assertEquals($result, $velocityChecker->useCaptcha($loginAttempt, $counter));

        // After captcha is active we should ONLY increase the IP counter

    }

    /**
     * Data provider for use captcha test
     *
     * @return array
     */
    public function useCaptchaDataProvider()
    {
        // 2 requests from same IP
        $requests1 = array(
            array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill1'),
            array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill2'),
        );

        // 3 requests from same IP
        $requests2 = array(
            array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill1'),
            array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill2'),
            array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill3'),
        );

        // 499 requests from same IP range
        $requests3 = array();
        for ($i = 0; $i < 499; $i++) {
            $requests3[] = array('ip' => '192.168.0.'.intval($i / 2), 'ip_country' => 'US', 'username' => 'bill' . $i);
        }

        // 500 requests from same IP range
        $requests4 = array();
        for ($i = 0; $i < 500; $i++) {
            $requests4[] = array('ip' => '192.168.0.'.intval($i / 2), 'ip_country' => 'US', 'username' => 'bill' . $i);
        }

        // 999 requests from same IP country
        $requests5 = array();
        for ($i = 0; $i < 499; $i++) {
            $requests5[] = array('ip' => '192.168.0.'.intval($i / 2), 'ip_country' => 'US', 'username' => 'bill' . $i);
        }
        for ($i = 0; $i < 499; $i++) {
            $requests5[] = array('ip' => '192.168.1.'.intval($i / 2), 'ip_country' => 'US', 'username' => 'bill' . ($i + 500));
        }
        for ($i = 0; $i < 1; $i++) {
            $requests5[] = array('ip' => '192.168.2.'.intval($i / 2), 'ip_country' => 'US', 'username' => 'bill' . ($i + 1000));
        }

        // 1000 requests from same IP range
        for ($i = 0; $i < 499; $i++) {
            $requests6[] = array('ip' => '192.168.0.'.intval($i / 2), 'ip_country' => 'US', 'username' => 'bill');
        }
        for ($i = 0; $i < 499; $i++) {
            $requests6[] = array('ip' => '192.168.1.'.intval($i / 2), 'ip_country' => 'US', 'username' => 'bill');
        }
        for ($i = 0; $i < 2; $i++) {
            $requests6[] = array('ip' => '192.168.2.'.intval($i / 2), 'ip_country' => 'US', 'username' => 'bill');
        }

        // 2 requests with same username
        $requests7 = array(
            array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
            array('ip' => '192.168.0.2', 'ip_country' => 'US', 'username' => 'bill'),
        );

        // 3 requests with same username
        $requests8 = array(
            array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
            array('ip' => '192.168.0.2', 'ip_country' => 'US', 'username' => 'bill'),
            array('ip' => '192.168.0.3', 'ip_country' => 'US', 'username' => 'bill'),
        );

        return array(
            array(
                false,
                array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
                $requests1
            ),
            array(
                true,
                array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
                $requests2
            ),
            array(
                false,
                array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
                $requests3
            ),
            array(
                true,
                array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
                $requests4
            ),
            array(
                false,
                array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
                $requests5
            ),
            array(
                true,
                array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
                $requests6
            ),
            array(
                false,
                array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
                $requests7
            ),
            array(
                true,
                array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
                $requests8
            ),
        );
    }
}
