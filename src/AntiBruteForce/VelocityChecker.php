<?php
namespace Kata\AntiBruteForce;

/**
 * Class VelocityChecker
 *
 * @package Kata\AntiBruteForce
 *
 * @author Janos Pribelszki
 */
class VelocityChecker {

    /**
     * Maximum number of failed login attempts from one IP - after thet captcha is being displayed
     */
    const MAX_FAILED_LOGIN_IP = 3;

    /**
     * Maximum number of failed login attempts from one IP range - after thet captcha is being displayed
     */
    const MAX_FAILED_LOGIN_RANGE = 500;

    /**
     * Maximum number of failed login attempts from one IP country - after that captcha is being displayed
     */
    const MAX_FAILED_LOGIN_COUNTRY = 1000;

    /**
     * Maximum number of failed login attempts with one username - after that captcha is being displayed
     */
    const MAX_FAILED_LOGIN_USERNAME = 3;

    /**
     * Returns true if we use captcha; false otherwise
     *
     * @param array $loginAttempt Current login attempt
     * @param Counter $counter    Failed login attempts counter
     *
     * @return bool
     */
    public function useCaptcha($loginAttempt, Counter $counter)
    {
        // IP
        if ($counter->getFailedLoginCountIp($loginAttempt['ip']) >= self::MAX_FAILED_LOGIN_IP) {
            return true;
        }

        // IP range
        $ipArr = explode('.', $loginAttempt['ip']);
        $ipArr[3] = 'x';
        $ipX = implode('.', $ipArr);
        if ($counter->getFailedLoginCountIpRange($ipX) >= self::MAX_FAILED_LOGIN_RANGE) {
            return true;
        }

        // IP country
        if ($counter->getFailedLoginCountIpCountry($loginAttempt['ip_country']) >= self::MAX_FAILED_LOGIN_COUNTRY) {
            return true;
        }

        // Login username
        if ($counter->getFailedLoginCountUsername($loginAttempt['username']) >= self::MAX_FAILED_LOGIN_USERNAME) {
            return true;
        }

        return false;
    }
}