<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/21/2018
 * Time: 6:52 PM
 */

function connectToDB() {
    $dsn = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw errors as exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Return arrays by default
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
    ];

    try {
        $conn = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    } catch (PDOException $e) {
        throw $e; 
    }
    return $conn;
}

function lookup_user($username) {
    $conn = connectToDB();
    $stmt = $conn->prepare("
    SELECT * FROM " . USERS_TABLE . 
    " WHERE " . USERS_USERNAME_FIELD . " = :username;
    ");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function add_user($username, $hash) {
    $conn = connectToDB();
    $stmt = $conn->prepare("
    INSERT INTO " . USERS_TABLE . " (" . USERS_USERNAME_FIELD . ", " . USERS_HASH_FIELD . ")
    VALUES (:username, :hash);
    ");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
    $stmt->execute();
}

function lookup_session($userID) {
    $conn = connectToDB();;
    $stmt = $conn->prepare("
    SELECT *
    FROM " . ACCOUNT_DATA_TABLE .
    " WHERE " . ACCOUNT_DATA_USER_ID_FIELD . " = :userID;
    ");
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function add_session($userID, $session) {
    if ($userID !== null) {   
        try {
            $conn = connectToDB();
            $stmt = $conn->prepare("
            INSERT INTO " . ACCOUNT_DATA_TABLE . " (" . ACCOUNT_DATA_USER_ID_FIELD . ", " . ACCOUNT_DATA_SESSION_DATA_FIELD . ")
            VALUES (:userID, :session)
            ON DUPLICATE KEY UPDATE " . ACCOUNT_DATA_SESSION_DATA_FIELD . " = :sessionDup;
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

function lookup_categories() {
    $conn = connectToDB();
    $stmt = $conn->query("
    SELECT " . PRODUCT_CATEGORY_ID_FIELD . ", " . PRODUCT_CATEGORY_NAME_FIELD . 
    " FROM " . PRODUCT_CATEGORY_TABLE . ";
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function lookup_subcategories($categoryID) {
    $conn = connectToDB();
    $stmt = $conn->prepare("
    SELECT " . PRODUCT_SUBCATEGORY_NAME_FIELD . 
    " FROM " . PRODUCT_SUBCATEGORY_TABLE . 
    " WHERE " . PRODUCT_SUBCATEGORY_CATEGORY_ID_FIELD . " = :categoryID;
    ");
    $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function lookup_product_groups($category, $subcategory) {
    $conn = connectToDB();
    $stmt = $conn->prepare("
    SELECT " . PRODUCT_GROUP_ID_FIELD . ", " . PRODUCT_GROUP_CODE_FIELD . ", " . PRODUCT_GROUP_DESCRIPTION_FIELD . ", " .
    PRODUCT_CATEGORY_NAME_FIELD . ", " . PRODUCT_SUBCATEGORY_NAME_FIELD . 
    " FROM " . PRODUCT_GROUP_TABLE . 
    " JOIN " . PRODUCT_CATEGORY_TABLE . 
    " ON " . PRODUCT_GROUP_TABLE . "." . PRODUCT_GROUP_CATEGORY_ID_FIELD . 
    " = " . PRODUCT_CATEGORY_TABLE . "." . PRODUCT_CATEGORY_ID_FIELD .
    " JOIN " . PRODUCT_SUBCATEGORY_TABLE . " 
    ON " . PRODUCT_GROUP_TABLE . "." . PRODUCT_GROUP_SUBCATEGORY_ID_FIELD . 
    " = " .  PRODUCT_SUBCATEGORY_TABLE . "." . PRODUCT_SUBCATEGORY_ID_FIELD .
    " WHERE " . PRODUCT_CATEGORY_NAME_FIELD. " = :category" .
    " AND " . PRODUCT_SUBCATEGORY_NAME_FIELD . " = :subcategory;
    ");
    $ucCategory = ucfirst($category);
    $ucSubcategory = ucfirst($subcategory);
    $stmt->bindParam(':category', $ucCategory, PDO::PARAM_STR);
    $stmt->bindParam(':subcategory', $ucSubcategory, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function lookup_group($groupID) {
    $conn = connectToDB();
    $stmt = $conn->prepare(
    "SELECT " . PRODUCT_GROUP_CODE_FIELD . ", " . PRODUCT_GROUP_DESCRIPTION_FIELD . ", " . PRODUCT_GROUP_INFORMATION_FIELD . 
    " FROM " . PRODUCT_GROUP_TABLE .
    " WHERE " . PRODUCT_ITEM_GROUP_ID_FIELD . " = :groupID;
    ");
    $stmt->bindParam(':groupID', $groupID, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function lookup_items($groupID) {
    $conn = connectToDB();
    $stmt = $conn->prepare("
    SELECT " . PRODUCT_ITEM_ID_FIELD . ', ' . PRODUCT_COLOR_NAME_FIELD . 
    ", " . PRODUCT_SIZE_DESCRIPTION_FIELD . ", " . PRODUCT_ITEM_PRICE_FIELD . 
    " FROM " . PRODUCT_ITEM_TABLE . 
    " LEFT JOIN " . PRODUCT_COLOR_TABLE . 
    " ON " . PRODUCT_ITEM_TABLE . "." . PRODUCT_ITEM_COLOR_ID_FIELD . 
    " = " . PRODUCT_COLOR_TABLE . "." . PRODUCT_COLOR_ID_FIELD . 
    " LEFT JOIN " . PRODUCT_SIZE_TABLE . 
    " ON " . PRODUCT_ITEM_TABLE . "." . PRODUCT_ITEM_SIZE_ID_FIELD . 
    " = " . PRODUCT_SIZE_TABLE . "." . PRODUCT_SIZE_ID_FIELD . 
    " WHERE " . PRODUCT_ITEM_GROUP_ID_FIELD . " = :groupID;
    ");
    $stmt->bindParam(':groupID', $groupID, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

