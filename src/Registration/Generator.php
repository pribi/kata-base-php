<?php
namespace Kata\Registration;

/**
 * Class Generator
 * @package Kata\Registration
 */
class Generator {
    /**
     * Generates a random password
     *
     * @return string
     */
    public function randomPassword()
    {
        $randomPassword = '';
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXZY0123456789.?!@#$%^&*()_=-+[]{},;:"|<>/';

        $length = mt_rand(8, 16);
        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $alphabet[mt_rand(0, strlen($alphabet) - 1)];
        }

        return $randomPassword;
    }
}
