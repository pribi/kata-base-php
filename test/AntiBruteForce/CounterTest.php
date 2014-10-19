<?php

namespace Kata\AntiBruteForce\Counter;

use Kata\AntiBruteForce\Counter;

/**
 * Class CounterTest
 *
 * @package Kata\AntiBruteForce
 *
 * @author Janos Pribelszki
 */
class CounterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * PHPUnit get failed login count by IP address test
     *
     * @param integer $ipCount Number of failed login attempts from an IP
     * @param string $ip              Ip address
     * @param array $failedLogins     Failed login attempts
     *
     * @dataProvider getFailedLoginCountDataProviderIp
     */
    public function testGetFailedLoginCountIp($ipCount, $ip, $failedLogins)
    {
        $counter = new Counter();
        $counter->logFailedLogins($failedLogins);

        $this->assertEquals($ipCount, $counter->getFailedLoginCountIp($ip));
    }

    /**
     * PHPUnit get failed login count by IP address range test
     *
     * @param integer $ipRangeCount   Number of failed login attempts from an IP range
     * @param string $ipRange         Ip address range
     * @param array $failedLogins     Failed login attempts
     *
     * @dataProvider getFailedLoginCountDataProviderIpRange
     */
    public function testGetFailedLoginCountIpRange($ipRangeCount, $ipRange, $failedLogins)
    {
        $counter = new Counter();
        $counter->logFailedLogins($failedLogins);

        $this->assertEquals($ipRangeCount, $counter->getFailedLoginCountIpRange($ipRange));
    }

    /**
     * PHPUnit get failed login count by IP country test
     *
     * @param integer $ipCountryCount Number of failed login attempts from an IP country
     * @param string $ipCountry       Ip country
     * @param array $failedLogins     Failed login attempts
     *
     * @dataProvider getFailedLoginCountDataProviderIpCountry
     */
    public function testGetFailedLoginCountIpCountry($ipCountryCount, $ipCountry, $failedLogins)
    {
        $counter = new Counter();
        $counter->logFailedLogins($failedLogins);

        $this->assertEquals($ipCountryCount, $counter->getFailedLoginCountIpCountry($ipCountry));
    }

    /**
     * PHPUnit get failed login count by username test
     *
     * @param integer $usernameCount Login username count
     * @param string $username       Login username
     * @param array $failedLogins    Failed login attempts
     *
     * @dataProvider getFailedLoginCountDataProviderLogin
     */
    public function testGetFailedLoginCountUsername($usernameCount, $username, $failedLogins)
    {
        $counter = new Counter();
        $counter->logFailedLogins($failedLogins);

        $this->assertEquals($usernameCount, $counter->getFailedLoginCountUsername($username));
    }

    /**
     * PHPUnit get failed login count with and without active captcha
     */
    public function testGetFailedLoginCountCaptcha()
    {
        $counter = new Counter();

        // Captcha is inactive increase IP, IP range, IP country and username counters
        $counter->logFailedLogin('192.168.0.1', 'US', 'bill', false);
        $this->assertEquals(1, $counter->getFailedLoginCountIp('192.168.0.1'));
        $this->assertEquals(1, $counter->getFailedLoginCountIpRange('192.168.0.x'));
        $this->assertEquals(1, $counter->getFailedLoginCountIpCountry('US'));
        $this->assertEquals(1, $counter->getFailedLoginCountUsername('bill'));

        // Captcha is inactive increase IP, IP range, IP country and username counters
        $counter->logFailedLogin('192.168.0.1', 'US', 'bill', false);
        $this->assertEquals(2, $counter->getFailedLoginCountIp('192.168.0.1'));
        $this->assertEquals(2, $counter->getFailedLoginCountIpRange('192.168.0.x'));
        $this->assertEquals(2, $counter->getFailedLoginCountIpCountry('US'));
        $this->assertEquals(2, $counter->getFailedLoginCountUsername('bill'));

        // Captcha is inactive increase IP, IP range, IP country and username counters
        $counter->logFailedLogin('192.168.0.1', 'US', 'bill', false);
        $this->assertEquals(3, $counter->getFailedLoginCountIp('192.168.0.1'));
        $this->assertEquals(3, $counter->getFailedLoginCountIpRange('192.168.0.x'));
        $this->assertEquals(3, $counter->getFailedLoginCountIpCountry('US'));
        $this->assertEquals(3, $counter->getFailedLoginCountUsername('bill'));

        // Captcha is active increase only the IP counter
        $counter->logFailedLogin('192.168.0.1', 'US', 'bill', true);
        $this->assertEquals(4, $counter->getFailedLoginCountIp('192.168.0.1'));
        $this->assertEquals(3, $counter->getFailedLoginCountIpRange('192.168.0.x'));
        $this->assertEquals(3, $counter->getFailedLoginCountIpCountry('US'));
        $this->assertEquals(3, $counter->getFailedLoginCountUsername('bill'));
    }

    /**
     * Data provider for get failed login count ip
     *
     * @return array
     */
    public function getFailedLoginCountDataProviderIp()
    {
        return array(
            array(
                1,
                '192.168.0.1',
                array(
                    array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill', 'is_captcha_active' => false),
                    array('ip' => '192.168.0.2', 'ip_country' => 'US', 'username' => 'bill', 'is_captcha_active' => false),
                )
            ),
        );
    }

    /**
     * Data provider for get failed login count ip range
     *
     * @return array
     */
    public function getFailedLoginCountDataProviderIpRange()
    {
        return array(
            array(
                2,
                '192.168.0.x',
                array(
                    array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill', 'is_captcha_active' => false),
                    array('ip' => '192.168.0.2', 'ip_country' => 'US', 'username' => 'bill', 'is_captcha_active' => false),
                )
            ),
        );
    }

    /**
     * Data provider for get failed login count ip country
     *
     * @return array
     */
    public function getFailedLoginCountDataProviderIpCountry()
    {
        return array(
            array(
                '2',
                'US',
                array(
                    array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill', 'is_captcha_active' => false),
                    array('ip' => '192.168.0.2', 'ip_country' => 'US', 'username' => 'bill', 'is_captcha_active' => false),
                )
            ),
        );
    }

    /**
     * Data provider for get failed login count login
     *
     * @return array
     */
    public function getFailedLoginCountDataProviderLogin()
    {
        return array(
            array(
                '2',
                'bill',
                array(
                    array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill', 'is_captcha_active' => false),
                    array('ip' => '192.168.0.2', 'ip_country' => 'US', 'username' => 'bill', 'is_captcha_active' => false),
                )
            ),
        );
    }
}