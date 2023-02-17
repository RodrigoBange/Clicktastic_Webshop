<?php
// Repository
require_once(__DIR__ . '/Repository.php');
// Model
require_once(__DIR__ . '/../models/User.php');

class UserRepository extends Repository
{
    public function getAll() : ?array
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }

    }

    public function getUser($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE email= :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo $e->getMessage();
            return null;
        }
    }

    public function userExists($email) : bool
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE email= :email AND 'password' IS NOT NULL");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return (bool)$stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    public function emailExists($email) : bool
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE email= :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return (bool)$stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    public function registerUser($email, $firstname, $lastname, $password) : bool
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO users (email, password, first_name, last_name, is_admin)" .
                                                        " VALUES " . "(:email, :password, :firstname, :lastname, 0)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    /**
     * Register a customer's information without password (When placing an order without logging in)
     */
    public function registerCustomer($userInfo) : bool
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO users (email, phone_number, first_name, last_name, address, address_optional, city,
                   state, postal_code, country, is_admin) VALUES (:email, :phone_number, :first_name, :last_name,
                                                                  :address, :address_optional, :city, :state, :postal_code,
                                                                  :country, 0)");
            $stmt->execute($userInfo);
            return true;
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    public function addPassword($password, $email) : bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE users SET 'password' = :password WHERE email= :email");
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    public function getUserId($email)
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email= :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function updateUser($userInfo) : bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name,
             address = :address, address_optional = :address_optional, city = :city, state = :state, 
             postal_code = :postal_code, country = :country, phone_number = :phone_number WHERE email= :email");
            $stmt->execute($userInfo);
            return true;
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }

    }
}
