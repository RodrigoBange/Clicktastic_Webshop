<?php
// Repository
require_once(__DIR__ . '/Repository.php');

// Model
require_once(__DIR__ . '/../models/User.php');

class UserRepository extends Repository
{
    /**
     * Retrieves all users
     */
    public function getAll(): ?array
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

    /**
     * Gets a specific user by email
     */
    public function getUser(string $email): User|null
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

    /**
     * Checks if a user exists by email
     */
    public function userExists(string $email): bool
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

    /**
     * Checks if an email already exists
     */
    public function emailExists(string $email): bool
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

    /**
     * Registers a new user
     */
    public function registerUser(string $email, string $firstname, string $lastname, string $password): bool
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
    public function registerCustomer($userInfo): bool
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

    /**
     * Adds a password to an existing email (for customers without account)
     */
    public function addPassword($password, $email): bool
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

    /**
     * Gets user ID
     */
    public function getUserId(string $email): int
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email= :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * Updates an existing user with new information
     */
    public function updateUser(array $userInfo) : bool
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
