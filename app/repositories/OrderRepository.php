<?php
// Repository
require_once(__DIR__ . '/Repository.php');

// Model
require_once(__DIR__ . '/../models/Order.php');

class OrderRepository extends Repository
{
    /**
     * Inserts a new order into the database
     */
    public function createOrder(int $customerId, array $orderInfo): bool|int|string
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO orders (customer_id, order_date, address, address_optional, city, state, postal_code, country, phone_number, total)
                    VALUES (:customer_id, now(), :address, :address_optional, :city, :state, :postal_code, :country, :phone_number, :total)");
            $stmt->bindParam(':customer_id', $customerId);
            $stmt->bindParam(':address', $orderInfo['address']);
            $stmt->bindParam('address_optional', $orderInfo['address_optional']);
            $stmt->bindParam(':city', $orderInfo['city']);
            $stmt->bindParam(':state', $orderInfo['state']);
            $stmt->bindParam(':postal_code', $orderInfo['postal_code']);
            $stmt->bindParam(':country', $orderInfo['country']);
            $stmt->bindParam(':phone_number', $orderInfo['phone_number']);
            $stmt->bindParam(':total', $orderInfo['total']);
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            error_log($e);
            return 0;
        }
    }

    /**
     * Adds order items to the database
     */
    public function addOrderItems(int $orderId, array $items) : void
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO order_items (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)");
            $stmt->bindParam(':order_id', $orderId);
            foreach ($items as $item) {
                $stmt->bindParam(':product_id', $item['product_id']);
                $stmt->bindParam(':quantity', $item['product_quantity']);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            error_log($e);
            echo $e->getMessage();
        }
    }

    /**
     * Retrieves orders by a specific ID
     */
    public function getOrdersById(int $customerId): array|null
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, order_date, address,
            address_optional, city, state, postal_code, country, phone_number, total
            FROM orders WHERE customer_id = :id");
            $stmt->bindParam(':id', $customerId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e);
            return null;
        }
    }

    /**
     * Retrieves all orders
     */
    public function getAllOrders(): array|null
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, order_date, address,
            address_optional, city, state, postal_code, country, phone_number, total
            FROM orders");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log($e);
            return null;
        }
    }

    /**
     * Retrieves all products of a specific order
     */
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
