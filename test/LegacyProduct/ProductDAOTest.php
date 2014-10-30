<?php

define('TEST_DATABASE_FILE', './test.db');
require_once("../../src/LegacyProduct/ProductDao.php");
require_once("../../src/LegacyProduct/Product.php");
class ProductDAOTest extends PHPUnit_Framework_TestCase
{
    private $pdo;

    public function setup()
    {
        $dsn = sprintf("sqlite:%s", TEST_DATABASE_FILE);
        $this->pdo = new PDO($dsn);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $this->pdo->prepare(
            "CREATE TABLE product ( id INTEGER PRIMARY KEY, ean varchar(64) default '', name text default '' );"
        );
        $stmt->execute();
    }


    /**
     * @TODO more test cases with dataProvider!
     * @TODO empty result test case: return new NullProduct;
     */
    public function testGetByEan()
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO product (id, ean, name) VALUES (1, '', '');"
        );
        $stmt->execute();

        $productDao = new ProductDao($this->pdo);
        $product = $productDao->getByEan('');

        $this->assertEquals(1, $product->id);
        $this->assertEquals('', $product->ean);
        $this->assertEquals('', $product->name);
    }

    /**
     * @TODO similar to testGetByEan
     */
    public function testGetById()
    {
    }

    public function testCreate()
    {
    }

    public function testModify()
    {
    }

    public function testDelete()
    {
    }

    public function tearDown()
    {
        unlink(TEST_DATABASE_FILE);
    }
}