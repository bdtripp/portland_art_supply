<?php
namespace PAS;

use PDO;
use PDOException;

class Database
{
    public function connectToDB() {
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


    public function lookupUser($username) {
        $conn = $this->connectToDB();
        $stmt = $conn->prepare("
        SELECT * FROM " . DbConstants::USERS_TABLE . 
        " WHERE " . DbConstants::USERS_USERNAME_FIELD . " = :username;
        ");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($username, $hash) {
        $conn = $this->connectToDB();
        $stmt = $conn->prepare("
        INSERT INTO " . DbConstants::USERS_TABLE . " (" . DbConstants::USERS_USERNAME_FIELD . ", " . DbConstants::USERS_HASH_FIELD . ")
        VALUES (:username, :hash);
        ");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function lookupSession($userID) {
        $conn = $this->connectToDB();
        $stmt = $conn->prepare("
        SELECT *
        FROM " . DbConstants::ACCOUNT_DATA_TABLE .
        " WHERE " . DbConstants::ACCOUNT_DATA_USER_ID_FIELD . " = :userID;
        ");
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addSession($userID, $session) {
        if ($userID !== null) {   
            try {
                $conn = $this->connectToDB();
                $stmt = $conn->prepare("
                INSERT INTO " . DbConstants::ACCOUNT_DATA_TABLE . " (" . DbConstants::ACCOUNT_DATA_USER_ID_FIELD . ", " . DbConstants::ACCOUNT_DATA_SESSION_DATA_FIELD . ")
                VALUES (:userID, :session)
                ON DUPLICATE KEY UPDATE " . DbConstants::ACCOUNT_DATA_SESSION_DATA_FIELD . " = :sessionDup;
                ");
                $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
                $stmt->bindParam(':session', $session, PDO::PARAM_STR);
                $stmt->bindParam(':sessionDup', $session, PDO::PARAM_STR);
                $stmt->execute();
            } catch (Exception $e) {
                http_response_code(500); 
                echo $e;
            }
        }
    }

    public function lookupCategories() {
        $conn = $this->connectToDB();
        $stmt = $conn->query("
        SELECT " . DbConstants::PRODUCT_CATEGORY_ID_FIELD . ", " . DbConstants::PRODUCT_CATEGORY_NAME_FIELD . 
        " FROM " . DbConstants::PRODUCT_CATEGORY_TABLE . ";
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lookupSubcategories($categoryID) {
        $conn = $this->connectToDB();
        $stmt = $conn->prepare("
        SELECT " . DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD . 
        " FROM " . DbConstants::PRODUCT_SUBCATEGORY_TABLE . 
        " WHERE " . DbConstants::PRODUCT_SUBCATEGORY_CATEGORY_ID_FIELD . " = :categoryID;
        ");
        $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lookupProductGroups($category, $subcategory) {
        $conn = $this->connectToDB();
        $stmt = $conn->prepare("
        SELECT " . DbConstants::PRODUCT_GROUP_ID_FIELD . ", " . DbConstants::PRODUCT_GROUP_CODE_FIELD . ", " . DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD . ", " .
        DbConstants::PRODUCT_CATEGORY_NAME_FIELD . ", " . DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD . 
        " FROM " . DbConstants::PRODUCT_GROUP_TABLE . 
        " JOIN " . DbConstants::PRODUCT_CATEGORY_TABLE . 
        " ON " . DbConstants::PRODUCT_GROUP_TABLE . "." . DbConstants::PRODUCT_GROUP_CATEGORY_ID_FIELD . 
        " = " . DbConstants::PRODUCT_CATEGORY_TABLE . "." . DbConstants::PRODUCT_CATEGORY_ID_FIELD .
        " JOIN " . DbConstants::PRODUCT_SUBCATEGORY_TABLE . " 
        ON " . DbConstants::PRODUCT_GROUP_TABLE . "." . DbConstants::PRODUCT_GROUP_SUBCATEGORY_ID_FIELD . 
        " = " .  DbConstants::PRODUCT_SUBCATEGORY_TABLE . "." . DbConstants::PRODUCT_SUBCATEGORY_ID_FIELD .
        " WHERE " . DbConstants::PRODUCT_CATEGORY_NAME_FIELD. " = :category" .
        " AND " . DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD . " = :subcategory;
        ");
        $ucCategory = ucfirst($category);
        $ucSubcategory = ucfirst($subcategory);
        $stmt->bindParam(':category', $ucCategory, PDO::PARAM_STR);
        $stmt->bindParam(':subcategory', $ucSubcategory, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lookupGroup($groupID) {
        $conn = $this->connectToDB();
        $stmt = $conn->prepare(
        "SELECT " . DbConstants::PRODUCT_GROUP_CODE_FIELD . ", " . DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD . ", " . DbConstants::PRODUCT_GROUP_INFORMATION_FIELD . 
        " FROM " . DbConstants::PRODUCT_GROUP_TABLE .
        " WHERE " . DbConstants::PRODUCT_ITEM_GROUP_ID_FIELD . " = :groupID;
        ");
        $stmt->bindParam(':groupID', $groupID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function lookupItems($groupID) {
        $conn = $this->connectToDB();
        $stmt = $conn->prepare("
        SELECT " . DbConstants::PRODUCT_ITEM_ID_FIELD . ', ' . DbConstants::PRODUCT_COLOR_NAME_FIELD . 
        ", " . DbConstants::PRODUCT_SIZE_DESCRIPTION_FIELD . ", " . DbConstants::PRODUCT_ITEM_PRICE_FIELD . 
        " FROM " . DbConstants::PRODUCT_ITEM_TABLE . 
        " LEFT JOIN " . DbConstants::PRODUCT_COLOR_TABLE . 
        " ON " . DbConstants::PRODUCT_ITEM_TABLE . "." . DbConstants::PRODUCT_ITEM_COLOR_ID_FIELD . 
        " = " . DbConstants::PRODUCT_COLOR_TABLE . "." . DbConstants::PRODUCT_COLOR_ID_FIELD . 
        " LEFT JOIN " . DbConstants::PRODUCT_SIZE_TABLE . 
        " ON " . DbConstants::PRODUCT_ITEM_TABLE . "." . DbConstants::PRODUCT_ITEM_SIZE_ID_FIELD . 
        " = " . DbConstants::PRODUCT_SIZE_TABLE . "." . DbConstants::PRODUCT_SIZE_ID_FIELD . 
        " WHERE " . DbConstants::PRODUCT_ITEM_GROUP_ID_FIELD . " = :groupID;
        ");
        $stmt->bindParam(':groupID', $groupID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
