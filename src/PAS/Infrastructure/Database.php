<?php

declare(strict_types=1);

namespace PAS\Infrastructure;

use PDO;
use PDOException;

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
}
