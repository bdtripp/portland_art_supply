<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/21/2018
 * Time: 6:52 PM
 */

//TODO use paramterized queries instead of real_escape string

function lookup_user($username) {
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    $safe_username = $db->real_escape_string($username);
    $query = "SELECT * FROM " . USERS_TABLE . " WHERE " . USERS_USERNAME_FIELD . " = '$safe_username';";
    $result = $db->query($query);
    return $result->fetch_array(MYSQLI_ASSOC);
}

function add_user($username, $hash) {
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    $safe_username = $db->real_escape_string($username);
    $query = "INSERT INTO";
    $query .= " " . USERS_TABLE . " (" . USERS_USERNAME_FIELD . ", " . USERS_HASH_FIELD . ")";
    $query .= " VALUES ('$safe_username','$hash');";
    $db->query($query);
}

function lookup_session($userID) {
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);;
    $query = "SELECT *";
    $query .= " FROM " . ACCOUNT_DATA_TABLE;
    $query .= " WHERE " . ACCOUNT_DATA_USER_ID_FIELD . " = '$userID';";
    $result = $db->query($query);
    return $result->fetch_array(MYSQLI_ASSOC);
}

function add_session($userID, $session) {
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);

    if ($userID !== null) {
        $query = "INSERT INTO";
        $query .= " " . ACCOUNT_DATA_TABLE;
        $query .= " (" . ACCOUNT_DATA_USER_ID_FIELD . ", " . ACCOUNT_DATA_SESSION_DATA_FIELD. ")";
        $query .= " VALUES ('$userID','$session')";
        // $query .= " VALUES (" . ($userID === null ? "NULL" : $userID) . ", $session')";
        $query .= " ON DUPLICATE KEY UPDATE " . ACCOUNT_DATA_SESSION_DATA_FIELD . " = '$session';";
        $result = $db->query($query);
        $a = 2;
    }
}

function lookup_categories() {
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    $query = "SELECT " . PRODUCT_CATEGORY_ID_FIELD . ', ' . PRODUCT_CATEGORY_NAME_FIELD . " FROM " . PRODUCT_CATEGORY_TABLE;
    $result = $db->query($query);
    while ($category = $result->fetch_array(MYSQLI_ASSOC)) {
        $categories[] = $category;
    }
    return $categories;
}

function lookup_subcategories($categoryID) {
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    $query = "SELECT " . PRODUCT_SUBCATEGORY_NAME_FIELD . " FROM " . PRODUCT_SUBCATEGORY_TABLE . " WHERE ";
    $query .= PRODUCT_SUBCATEGORY_CATEGORY_ID_FIELD . " = " . $categoryID;
    $result = $db->query($query);
    while ($subcat = $result->fetch_array(MYSQLI_ASSOC)) {
        $subcats[] = $subcat;
    }
    return $subcats;
}

function lookup_product_groups($category, $subcategory) {
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    $query = "SELECT " . PRODUCT_GROUP_ID_FIELD . ", " . PRODUCT_GROUP_CODE_FIELD . ", " . PRODUCT_GROUP_DESCRIPTION_FIELD . ", ";
    $query .= PRODUCT_CATEGORY_NAME_FIELD . ", " . PRODUCT_SUBCATEGORY_NAME_FIELD . " FROM " . PRODUCT_GROUP_TABLE;
    $query .= " JOIN " . PRODUCT_CATEGORY_TABLE . " ON " . PRODUCT_GROUP_TABLE . "." . PRODUCT_GROUP_CATEGORY_ID_FIELD;
    $query .= " = " . PRODUCT_CATEGORY_TABLE . "." . PRODUCT_CATEGORY_ID_FIELD;
    $query .= " JOIN " . PRODUCT_SUBCATEGORY_TABLE . " ON " . PRODUCT_GROUP_TABLE . "." . PRODUCT_GROUP_SUBCATEGORY_ID_FIELD;
    $query .= " = " .  PRODUCT_SUBCATEGORY_TABLE . "." . PRODUCT_SUBCATEGORY_ID_FIELD;
    $query .= " WHERE " . PRODUCT_CATEGORY_NAME_FIELD. " = '" . ucfirst($category) . "'";
    $query .= " AND " . PRODUCT_SUBCATEGORY_NAME_FIELD . " = '" . ucfirst($subcategory) . "'";
    $result = $db->query($query);
    while($product_group = $result->fetch_array(MYSQLI_ASSOC)) {
        $product_groups[] = $product_group;
    };
    return $product_groups;
}

function lookup_group($groupID) {
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    $query = "SELECT " . PRODUCT_GROUP_CODE_FIELD . ", " . PRODUCT_GROUP_DESCRIPTION_FIELD . ", ";
    $query .= PRODUCT_GROUP_INFORMATION_FIELD . " FROM " . PRODUCT_GROUP_TABLE;
    $query .= " WHERE " . PRODUCT_ITEM_GROUP_ID_FIELD . " = " . $groupID;
    $result = $db->query($query);
    return $result->fetch_array(MYSQLI_ASSOC);
}

function lookup_items($groupID) {
    $db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    $query = "SELECT " . PRODUCT_ITEM_ID_FIELD . ', ' . PRODUCT_COLOR_NAME_FIELD . ", ";
    $query .= PRODUCT_SIZE_DESCRIPTION_FIELD . ", " . PRODUCT_ITEM_PRICE_FIELD . " FROM " . PRODUCT_ITEM_TABLE;
    $query .= " LEFT JOIN " . PRODUCT_COLOR_TABLE . " ON " . PRODUCT_ITEM_TABLE . "." . PRODUCT_ITEM_COLOR_ID_FIELD;
    $query .= " = " . PRODUCT_COLOR_TABLE . "." . PRODUCT_COLOR_ID_FIELD . " LEFT JOIN " . PRODUCT_SIZE_TABLE;
    $query .= " ON " . PRODUCT_ITEM_TABLE . "." . PRODUCT_ITEM_SIZE_ID_FIELD . " = " . PRODUCT_SIZE_TABLE . ".";
    $query .= PRODUCT_SIZE_ID_FIELD . " WHERE " . PRODUCT_ITEM_GROUP_ID_FIELD . " = " . $groupID;
    $result = $db->query($query);
    while($item = $result->fetch_array(MYSQLI_ASSOC)) {
        $items[] = $item;
    };
    return $items;
}

