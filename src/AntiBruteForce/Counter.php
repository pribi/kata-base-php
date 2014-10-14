<?php

namespace Kata\AntiBruteForce;

/**
 * Class Counter
 *
 * @package Kata\AntiBruteForce
 *
 * @author Janos Pribelszki
 */
class Counter {

    /**
     *
     *
     * @var array
     */
    private $failedLoginAttempts = array();

    /**
     * Logs a failed login attempt
     *
     * @param $ip         IP address
     * @param $ip_country IP country
     * @param $username   Username
     */
    public function logFailedLoginAttempt($ip, $ip_country, $username)
    {
        $this->failedLoginAttempts[] = array(
            'ip' => $ip,
            'ip_country' => $ip_country,
            'username' => $username,
            'ts' => time(),
        );
    }

    /**
     * Returns number of requests from an IP
     *
     * @param $ip IP address
     * @return int Number of requests from an IP
     */
    public function getFailedLoginCountIp($ip)
    {
        $counter = 0;
        foreach ($this->failedLoginAttempts as $attempt) {
            if ($attempt['ip'] == $ip) {
                $counter++;
            }
        }

        return $counter;
    }

    /**
     * Returns number of requests from an IP range
     *
     * @param $ipRange IP address
     * @return int Number of requests from an IP range
     */
    public function getFailedLoginCountIpRange($ipRange)
    {
        $counter = 0;
        foreach ($this->failedLoginAttempts as $attempt) {
            $ipArr = explode('.', $attempt['ip']);
            $ipArr[3] = 'x';
            $ipX = implode('.', $ipArr);

            if ($ipRange == $ipX) {
                $counter++;
            }
        }

        return $counter;
    }
}