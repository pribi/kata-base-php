<?php
/**
 * Class ProductDao
 */
class ProductDao {
    /**
     * @var \PDO Database resource.
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get product by EAN.
     *
     * @param $ean
     * @return NullProduct|Product
     */
    public function getByEan($ean)
    {
        $sth = $this->getPdo()->prepare("SELECT * FROM product WHERE ean = :ean");
        $sth->execute(
            array(
                ':ean' => $ean,
            )
        );
        $rows = $sth->fetchAll();
        if (count($rows) > 0)
        {
            $row = $rows[0];
            $product = new Product;
            $product->id = $row['id'];
            $product->name = $row['name'];
            $product->ean = $row['ean'];
            return $product;
        }
        return new NullProduct;
    }
    /**
     * Get product by id.
     *
     * @param $id
     * @return NullProduct|Product
     */
    public function getById($id)
    {
        $sth = $this->getPdo()->prepare("SELECT * FROM product WHERE id = :id");
        $sth->execute(
            array(
                ':id' => $id,
            )
        );
        $rows = $sth->fetchAll();
        if (count($rows) > 0)
        {
            $row = $rows[0];
            $product = new Product;
            $product->id = $row['id'];
            $product->name = $row['name'];
            $product->ean = $row['ean'];
            return $product;
        }
        return new NullProduct;
    }
    /**
     * Create product in database if the EAN is not existing.
     *
     * @param Product $product
     * @return bool
     */
    public function create(Product $product)
    {
        if ($this->checkUnique($product->ean))
        {
            $sth = $this->getPdo()->prepare("
INSERT INTO product
(ean, name)
VALUES
(:ean, :name)
");
            $sth->execute(
                array(
                    ':ean' => $product->ean,
                    ':name' => $product->name,
                )
            );
            return true;
        }
        else
        {
            return false;
        }
    }
    /**
     * Modify the product name and ean in database by id.
     * It checks if the EAN already exists by another product, and does not overwrite.
     *
     * @param Product $product
     * @return bool
     */
    public function modify(Product $product)
    {
        if ($this->checkUnique($product->ean))
        {
            $sth = $this->getPdo()->prepare("
UPDATE product
SET
ean = :ean,
name = :name
WHERE id = :id
");
            $sth->execute(
                array(
                    ':id' => $product->id,
                    ':ean' => $product->ean,
                    ':name' => $product->name,
                )
            );
        }
        return true;
    }
    /**
     * Delete product from database
     *
     * @param Product $product
     * @return bool
     */
    public function delete(Product $product)
    {
        $sth = $this->getPdo()->prepare("DELETE FROM product WHERE id = :id");
        $sth->execute(
            array(
                ':id' => $product->id,
            )
        );
        return true;
    }
    /**
     * Internal PDO getter
     *
     * @return PDO
     */
    private function getPdo()
    {
        return $this->pdo;
    }
    /**
     * Check if the product will be unique by EAN
     *
     * @param $ean
     * @return bool
     */
    private function checkUnique($ean)
    {
        $sth = $this->getPdo()->prepare("SELECT COUNT(1) FROM product WHERE ean = :ean");
        $sth->execute(
            array(
                ':ean' => $ean,
            )
        );
        $countRow = $sth->fetch();
        if ($countRow[0] > 0)
        {
            return false;
        }
        return true;
    }
}
