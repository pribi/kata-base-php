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
     * Maximum number of failed login attempts from one IP - after captcha is being displayed
     */
    const MAX_LOGIN_IP = 3;

    /**
     * Maximum number of failed login attempts from one IP range - after captcha is being displayed
     */
    const MAX_LOGIN_RANGE = 500;

    /**
     * Maximum number of failed login attempts from one IP country - after captcha is being displayed
     */
    const MAX_LOGIN_COUNTRY = 1000;

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
        if ($counter->getFailedLoginCountIp($loginAttempt['ip']) >= self::MAX_LOGIN_IP) {
            return true;
        }

        // IP range
        $ipArr = explode('.', $loginAttempt['ip']);
        $ipArr[3] = 'x';
        $ipX = implode('.', $ipArr);
        if ($counter->getFailedLoginCountIpRange($ipX) >= self::MAX_LOGIN_RANGE) {
            return true;
        }

        // IP country
        if ($counter->getFailedLoginCountIpCountry($loginAttempt['ip_country']) >= self::MAX_LOGIN_COUNTRY) {
            return true;
        }

        return false;
    }
}