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
     * @param mixed $result
     * @param string $ean
     * @param array $products
     *
     * @dataProvider getByEanDataProvider
     */
    public function testGetByEan($result, $ean, $products)
    {
        if (!empty($products)) {
            foreach ($products as $product) {
                $stmt = $this->pdo->prepare(
                    "INSERT INTO product (id, ean, name) VALUES (".$product['id'].", '".$product['ean']."', '".$product['name']."');"
                );
                $stmt->execute();
            }
        }


        $productDao = new ProductDao($this->pdo);
        $this->assertEquals($result, $productDao->getByEan($ean));
    }

    /**
     * @param mixed $result
     * @param int $id
     * @param array $products
     *
     * @dataProvider getByIdDataProvider
     */
    public function testGetById($result, $id, $products)
    {
        if (!empty($products)) {
            foreach ($products as $product) {
                $stmt = $this->pdo->prepare(
                    "INSERT INTO product (id, ean, name) VALUES (".$product['id'].", '".$product['ean']."', '".$product['name']."');"
                );
                $stmt->execute();
            }
        }


        $productDao = new ProductDao($this->pdo);
        $this->assertEquals($result, $productDao->getById($id));
    }

    public function getByEanDataProvider()
    {
        $product1 = new Product();
        $product1->id = 1;
        $product1->ean = '';
        $product1->name = '';

        $product2 = new Product();
        $product2->id = 2;
        $product2->ean = '2';
        $product2->name = '2';

        return array(
            array(new NullProduct(), '', array()),
            array($product1, '', array(array('id' => 1, 'ean' => '', 'name' => ''))),
            array($product2, '2', array(array('id' => 2, 'ean' => '2', 'name' => '2'))),
            array($product1, '', array(array('id' => 1, 'ean' => '', 'name' => ''), array('id' => 2, 'ean' => '2', 'name' => '2'))),
            array($product2, '2', array(array('id' => 1, 'ean' => '', 'name' => ''), array('id' => 2, 'ean' => '2', 'name' => '2'))),
        );
    }

    public function getByIdDataProvider()
    {
        $product1 = new Product();
        $product1->id = 1;
        $product1->ean = '';
        $product1->name = '';

        $product2 = new Product();
        $product2->id = 2;
        $product2->ean = '2';
        $product2->name = '2';

        return array(
            array(new NullProduct(), '', array()),
            array($product1, 1, array(array('id' => 1, 'ean' => '', 'name' => ''))),
            array($product2, 2, array(array('id' => 2, 'ean' => '2', 'name' => '2'))),
            array($product1, 1, array(array('id' => 1, 'ean' => '', 'name' => ''), array('id' => 2, 'ean' => '2', 'name' => '2'))),
            array($product2, 2, array(array('id' => 1, 'ean' => '', 'name' => ''), array('id' => 2, 'ean' => '2', 'name' => '2'))),
        );
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