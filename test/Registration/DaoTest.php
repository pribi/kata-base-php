<?php

namespace Kata\Registration\Dao;

use Kata\Registration\User;
use Kata\Registration\Dao;

/**
 * Class DaoTest
 * @package Registration
 */
class DaoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Database connection
     *
     * @var PDO
     */
    private $db;

    /**
     * Insert users into database
     *
     * @param array $users User data
     */
    private function insertUsers(array $users)
    {
        if (!empty($users)) {
            foreach ($users as $user) {
                $this->db->query("
                  INSERT INTO users (" . implode(", ", array_keys($user)) . ")
                  VALUES ('" . implode("', '", array_values($user)). "');
                ");
            }
        }
    }

    /**
     * Setup
     */
    public function setup()
    {
        $this->db = new \PDO("sqlite::memory:");
        $this->db->query("
            CREATE TABLE users (
              username VARCHAR(128) NOT NULL,
              password_hash VARCHAR(64) NOT NULL,
              PRIMARY KEY (username)
            );
        ");
    }

    /**
     * PHPUnit store test
     *
     * @param User $user User object
     * @param array $usersAfter Database contents after user has been stored
     *
     * @dataProvider storeDataProvider
     */
    public function atestStore(User $user, $usersAfter)
    {
        $dao = new Dao($this->db);
        $dao->store($user);

        $this->assertSame($usersAfter, $this->db->query("SELECT * FROM users")->fetchAll());
    }

    /**
     * Data provider for store test
     *
     * @return array
     */
    public function storeDataProvider()
    {
        $user = new User();
        $user->username = 'Username';
        $user->password_hash = 'Hash';

        return array(
            array(
                $user,
                array(array('username' => 'Username', 0 => 'Username', 'password_hash' => 'Hash', 1 => 'Hash')),
            )
        );
    }

    /**
     * PHPUnit store throws user exists exception test
     *
     * @param User $user User object
     * @param array $usersBefore Database contents before user has been stored
     *
     * @expectedException Exception
     * @expectedExceptionMessage User already exists!
     *
     * @dataProvider storeThrowsUserExistsExceptionDataProvider
     */
    public function testStoreThrowsUserExistsException(User $user, $usersBefore)
    {
        $this->insertUsers($usersBefore);

        $dao = new Dao($this->db);
        $dao->store($user);
    }

    /**
     * Data provider for store throws user exists exception test
     *
     * @return array
     */
    public function storeThrowsUserExistsExceptionDataProvider()
    {
        $user = new User();
        $user->username = 'Username';
        $user->password_hash = 'Hash';

        return array(
            array(
                $user,
                array(array('username' => 'Username', 'password_hash' => 'Hash')),
            )
        );
    }
}
