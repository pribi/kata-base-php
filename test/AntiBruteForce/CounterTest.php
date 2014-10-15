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
     * @param integer $ipRangeCount   Number of failed login attempts from an IP range
     * @param string $ipRange         Ip address range
     * @param integer $ipCountryCount Number of failed login attempts from an IP country
     * @param string $ipCountry       Ip country
     * @param array $requests         Failed login attempts
     *
     * @dataProvider getFailedLoginCountDataProvider
     */
    public function testGetFailedLoginCount($ipCount, $ip, $ipRangeCount, $ipRange, $ipCountryCount, $ipCountry, $requests)
    {
        $counter = new Counter();
        foreach ($requests as $request) {
            $counter->logFailedLoginAttempt($request['ip'], $request['ip_country'], $request['username']);
        }

        $this->assertEquals($ipCount, $counter->getFailedLoginCountIp($ip));
        $this->assertEquals($ipRangeCount, $counter->getFailedLoginCountIpRange($ipRange));
        $this->assertEquals($ipCountryCount, $counter->getFailedLoginCountIpCountry($ipCountry));
    }

    /**
     * Data provider for get failed login count
     *
     * @return array
     */
    public function getFailedLoginCountDataProvider()
    {
        return array(
            array(
                1,
                '192.168.0.1',
                2,
                '192.168.0.x',
                '2',
                'US',
                array(
                    array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
                    array('ip' => '192.168.0.2', 'ip_country' => 'US', 'username' => 'bill'),
                )
            ),
        );
    }
}