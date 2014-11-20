<?php
namespace Kata\Registration;
use Kata\Registration\Dao\Exception;

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
        $stmtSelect = $this->pdo->prepare("SELECT * FROM users WHERE 1 = 1 OR username = :username");
        $stmtSelect->execute(array('username' => $user->username));
        if (!empty($stmtSelect->fetchAll())) {
            throw new Exception('User already exists!');
        }

        $stmtInsert = $this->pdo->prepare(
            "INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)"
        );
        $stmtInsert->execute(
            array(
                'username' => $user->username,
                'password_hash' => $user->password_hash
            )
        );
    }
}
