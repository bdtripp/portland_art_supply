<?php

declare(strict_types=1);

namespace PAS\Infrastructure;

use PDO;
use PDOException;
use PAS\Config\DbConstants;

class Database
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = $this->connectToDB();
    }

    public function connectToDB(): PDO
    {
        $dsn = "mysql:host=" . $_ENV['DB_HOST'] .
        ";port=" . $_ENV['DB_PORT'] .
        ";dbname=" . $_ENV['DB_NAME'] .
        ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw errors as exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Return arrays by default
            PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
        ];

        try {
            $conn = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $options);
        } catch (PDOException $e) {
            throw $e;
        }
        return $conn;
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }

    /**
     * @return array<int, array{
     *     category_id: int,
     *     category_name: string
     * }>
     */
    public function lookupCategories(): array
    {
        $conn = $this->conn;
        $stmt = $conn->query("
        SELECT " . DbConstants::PRODUCT_CATEGORY_ID_FIELD . ", " . DbConstants::PRODUCT_CATEGORY_NAME_FIELD .
        " FROM " . DbConstants::PRODUCT_CATEGORY_TABLE . ";
        ");

        if ($stmt === false) {
            return [];
        }

        /** @var array<int, array{category_id: int, category_name: string}> */
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array<int, array{
     *      subcategory_name: string
     * }>
     */
    public function lookupSubcategories(int $categoryID): array
    {
        $conn = $this->conn;
        $stmt = $conn->prepare("
        SELECT " . DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD .
        " FROM " . DbConstants::PRODUCT_SUBCATEGORY_TABLE .
        " WHERE " . DbConstants::PRODUCT_SUBCATEGORY_CATEGORY_ID_FIELD . " = :categoryID;
        ");
        $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
