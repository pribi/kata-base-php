<?php
namespace Kata\Registration;

/**
 * Class Dao
 * @package Kata\Registration
 */
class Dao
{
    /**
     * Database connection
     *
     * @var \PDO
     */
    private $pdo;

    /**
     * Default constructor
     *
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Stores a user
     *
     * @param User $user
     */
    public function store(User $user)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)"
        );
        $stmt->execute(
            array(
                'username' => $user->username,
                'password_hash' => $user->password_hash
            )
        );
    }
}
