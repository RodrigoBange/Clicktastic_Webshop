<?php
// Repository
require_once(__DIR__ . '/Repository.php');

// Model
require_once(__DIR__ . '/../models/Product.php');

class ProductRepository extends Repository
{
    /**
     * Gets a specific order by ID
     */
    public function getProductById(int $id): Product|null
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM products WHERE id= :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetch();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function getAllProducts(): array|null
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM products");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Gets total product count
     */
    public function getProductCount(): int
    {
        try {
            $stmt = $this->connection->prepare("SELECT COUNT(*) as total FROM products");
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * Gets product count by specific keywords
     */
    public function getProductCountByKeywords(string $query, array $keywords): int
    {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($keywords);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo $e->getMessage();
            return 0;
        }
    }

    /**
     * Retrieves products within a specific limit
     */
    public function getProductsByLimit(int $limit): array|null
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM products ORDER BY id DESC LIMIT :limit");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Retrieves products within a limit and offset
     */
    public function getProductsByOffsetLimit(string $query, array $values): bool|array|null
    {
        try {
            $stmt = $this->connection->prepare($query);
            if (!empty($values)) {
                $stmt->execute($values);
            } else {
                $stmt->execute();
            }
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    public function getNewestProducts(): array|null
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM ( SELECT * FROM products ORDER BY id DESC LIMIT 3 )
                                                        as row ORDER BY id");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return null;
        }
    }

    public function getProductsOfOrder(int $id): bool|array|null
    {
        try {
            $stmt = $this->connection->prepare("SELECT products.*, order_items.quantity FROM products INNER JOIN order_items 
                                                ON products.id=order_items.product_id WHERE order_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e);
            return null;
        }
    }
}
