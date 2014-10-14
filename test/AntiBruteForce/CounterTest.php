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
class CounterTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * PHPUnit get failed login count by IP address test
     *
     * @param integer $count  Number of failed login attempts from an IP
     * @param string $ip      Ip address
     * @param array $requests Failed login attempts
     *
     * @dataProvider getFailedLoginCountIpDataProvider
     */
    public function testGetFailedLoginCountIp($count, $ip, $requests)
    {
        $counter = new Counter();
        foreach ($requests as $request) {
            $counter->logFailedLoginAttempt($request['ip'], $request['ip_country'], $request['username']);
        }

        $this->assertEquals($count, $counter->getFailedLoginCountIp($ip));
    }

    /**
     * Data provider for get failed login count by IP address
     *
     * @return array
     */
    public function getFailedLoginCountIpDataProvider()
    {
        return array(
            array(
                1,
                '192.168.0.1',
                array(
                    array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
                )
            ),
        );
    }

    /**
     * PHPUnit get failed login count by IP address range test
     *
     * @param integer $count  Number of failed login attempts from an IP range
     * @param string $ipRange Ip address range
     * @param array $requests Failed login attempts
     *
     * @dataProvider getFailedLoginCountIpRangeDataProvider
     */
    public function testGetFailedLoginCountIpRange($count, $ipRange, $requests)
    {
        $counter = new Counter();
        foreach ($requests as $request) {
            $counter->logFailedLoginAttempt($request['ip'], $request['ip_country'], $request['username']);
        }

        $this->assertEquals($count, $counter->getFailedLoginCountIpRange($ipRange));
    }

    /**
     * Data provider for get failed login count by IP address range
     *
     * @return array
     */
    public function getFailedLoginCountIpRangeDataProvider()
    {
        return array(
            array(
                2,
                '192.168.0.x',
                array(
                    array('ip' => '192.168.0.1', 'ip_country' => 'US', 'username' => 'bill'),
                    array('ip' => '192.168.0.2', 'ip_country' => 'US', 'username' => 'bill'),
                )
            ),
        );
    }
}