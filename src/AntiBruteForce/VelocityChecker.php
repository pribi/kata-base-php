<?php
namespace Kata\AntiBruteForce;

/**
 * Class VelocityChecker
 *
 * @package Kata\AntiBruteForce
 * @author Janos Pribelszki
 */
class VelocityChecker {
    /**
     * Returns true if we use captcha; false otherwise
     *
     * @return bool
     */
    public function useCaptcha()
    {
        return false;
    }
}