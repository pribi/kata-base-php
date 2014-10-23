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
     * Time To Live
     */
    const TTL = 3600;

    /**
     * Failed login attempts
     *
     * @var array
     */
    private $failedLoginAttempts = array();

    /**
     * Logs a failed login attempt
     *
     * @param string $ip                  IP address
     * @param string $ipCountry           IP country
     * @param string $username            Username
     * @param string $registrationCountry Username registration country
     * @param bool $isCaptchaActive       Is captcha active
     * @param integer $timeStamp          Timestamp
     */
    public function logFailedLogin($ip, $ipCountry, $username, $registrationCountry, $isCaptchaActive, $timeStamp = null)
    {
        // Log failed login attempt
        $this->failedLoginAttempts[] = array(
            'ip' => $ip,
            'ip_country' => $ipCountry,
            'username' => $username,
            'registration_country' => $registrationCountry,
            'ts' => ((null === $timeStamp) ? time() : $timeStamp),
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
                $failedLogin['registration_country'],
                $failedLogin['is_captcha_active']
            );
        }
    }

    /**
     * Returns number of requests from an IP
     *
     * @param string $ip         IP address
     * @param integer $checkWhen Timestamp: when to check count
     *
     * @return int Number of requests from an IP
     */
    public function getFailedLoginCountIp($ip, $checkWhen = null)
    {
        if (null === $checkWhen) {
            $checkWhen = time();
        }

        $counter = 0;
        foreach ($this->failedLoginAttempts as $attempt) {
            if (($attempt['ip'] == $ip) && ($attempt['ts'] >= ($checkWhen - self::TTL))) {
                $counter++;
            }
        }

        return $counter;
    }

    /**
     * Returns number of requests from an IP range
     *
     * @param string $ipRange IP address
     * @param integer $checkWhen Timestamp: when to check count
     *
     * @return int Number of requests from an IP range
     */
    public function getFailedLoginCountIpRange($ipRange, $checkWhen = null)
    {
        if (null === $checkWhen) {
            $checkWhen = time();
        }

        $counter = 0;
        foreach ($this->failedLoginAttempts as $attempt) {
            $ipArr = explode('.', $attempt['ip']);
            $ipArr[3] = 'x';
            $ipX = implode('.', $ipArr);

            if ($ipRange == $ipX && !$attempt['is_captcha_active'] && ($attempt['ts'] >= ($checkWhen - self::TTL))) {
                $counter++;
            }
        }

        return $counter;
    }

    /**
     * Returns number of requests from an IP country
     *
     * @param string $ipCountry IP country
     * @param integer $checkWhen Timestamp: when to check count
     *
     * @return int Number of requests from an IP
     */
    public function getFailedLoginCountIpCountry($ipCountry, $checkWhen = null)
    {
        if (null === $checkWhen) {
            $checkWhen = time();
        }

        $counter = 0;
        foreach ($this->failedLoginAttempts as $attempt) {
            if ($attempt['ip_country'] == $ipCountry && !$attempt['is_captcha_active'] && ($attempt['ts'] >= ($checkWhen - self::TTL))) {
                $counter++;
            }
        }

        return $counter;
    }

    /**
     * Returns number of requests with a username
     *
     * @param string $username Username
     * @param integer $checkWhen Timestamp: when to check count
     *
     * @return int Number of requests with a username
     */
    public function getFailedLoginCountUsername($username, $checkWhen = null)
    {
        if (null === $checkWhen) {
            $checkWhen = time();
        }

        $counter = 0;
        foreach ($this->failedLoginAttempts as $attempt) {
            if ($attempt['username'] == $username && !$attempt['is_captcha_active'] && ($attempt['ts'] >= ($checkWhen - self::TTL))) {
                $counter++;
            }
        }

        return $counter;
    }

    /**
     * Is username registration country different than IP country
     *
     * @param string $username Username
     * @param string $ip       IP address
     *
     * @return bool
     */
    public function isRegistrationCountyDifferent($username, $ip)
    {
        $use = false;
        foreach ($this->failedLoginAttempts as $attempt) {
            if ($attempt['username'] == $username && $attempt['ip'] == $ip) {
                $use = ($attempt['ip_country'] != $attempt['registration_country']);
            }
        }

        return $use;
    }
}
