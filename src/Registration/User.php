<?php
namespace Kata\Registration;

/**
 * Class User
 * @package Kata\Registration
 */
class User {
    /**
     * Username
     *
     * @var string
     */
    public $username;

    /**
     * Hashed password
     *
     * @var string
     */
    public $password_hash;

    /**
     * Plain password
     *
     * @var string
     */
    public $password_plain;
}
