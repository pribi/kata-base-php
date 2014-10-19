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
     * Failed login attempts
     *
     * @var array
     */
    private $failedLoginAttempts = array();

    /**
     * Logs a failed login attempt
     *
     * @param string $ip            IP address
     * @param string $ipCountry     IP country
     * @param string $username      Username
     * @param bool $isCaptchaActive Is captcha active
     */
    public function logFailedLogin($ip, $ipCountry, $username, $isCaptchaActive)
    {
        // Log failed login attempt
        $this->failedLoginAttempts[] = array(
            'ip' => $ip,
            'ip_country' => $ipCountry,
            'username' => $username,
            'ts' => time(),
            'is_captcha_active' => $isCaptchaActive,
        );
    }

    /**
     * Logs failed login attempts
     *
     * @param array $failedLogins Failed login attempts
     */
    public function logFailedLogins($failedLogins)
    {
        foreach ($failedLogins as $failedLogin) {
            $this->logFailedLogin(
                $failedLogin['ip'],
                $failedLogin['ip_country'],
                $failedLogin['username'],
                $failedLogin['is_captcha_active']
            );
        }
    }

    /**
     * Returns number of requests from an IP
     *
     * @param string $ip IP address
     *
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
     * @param string $ipRange IP address
     *
     * @return int Number of requests from an IP range
     */
    public function getFailedLoginCountIpRange($ipRange)
    {
        $counter = 0;
        foreach ($this->failedLoginAttempts as $attempt) {
            $ipArr = explode('.', $attempt['ip']);
            $ipArr[3] = 'x';
            $ipX = implode('.', $ipArr);

            if ($ipRange == $ipX && !$attempt['is_captcha_active']) {
                $counter++;
            }
        }

        return $counter;
    }

    /**
     * Returns number of requests from an IP country
     *
     * @param string $ipCountry IP country
     *
     * @return int Number of requests from an IP
     */
    public function getFailedLoginCountIpCountry($ipCountry)
    {
        $counter = 0;
        foreach ($this->failedLoginAttempts as $attempt) {
            if ($attempt['ip_country'] == $ipCountry && !$attempt['is_captcha_active']) {
                $counter++;
            }
        }

        return $counter;
    }

    /**
     * Returns number of requests with a username
     *
     * @param string $username Username
     *
     * @return int Number of requests with a username
     */
    public function getFailedLoginCountUsername($username)
    {
        $counter = 0;
        foreach ($this->failedLoginAttempts as $attempt) {
            if ($attempt['username'] == $username && !$attempt['is_captcha_active']) {
                $counter++;
            }
        }

        return $counter;
    }
}
