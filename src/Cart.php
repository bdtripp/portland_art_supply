<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 12/1/2018
 * Time: 10:16 AM
 */
require_once('db_constants.php');
require_once('utilities.php');
require_once('page_constants.php');

function getItemsInCart() {
    return get_session_value(SESSION_CART_KEY);
}

function addItemToCart($id, $category, $subcategory, $groupCode, $color, $size, $price, $quantity, $groupDescription) {
    $items = getItemsInCart();
    $newItem = true;

    if ($items !== null) {
        //check if the item already exists in the cart
        for ($count = 0; $count < count($items); $count++) {
            if ($items[$count][PRODUCT_ITEM_ID_FIELD] == $id) {
                $items[$count][QUANTITY_FIELD] += $quantity;
                $newItem = false;
                set_session_value(SESSION_CART_KEY, $items);
            }
        }
    }
    
    if ($newItem) {
        $items[] = array(PRODUCT_ITEM_ID_FIELD => $id, PRODUCT_CATEGORY_NAME_FIELD => $category,
            PRODUCT_SUBCATEGORY_NAME_FIELD => $subcategory, PRODUCT_GROUP_CODE_FIELD => $groupCode,
            PRODUCT_COLOR_NAME_FIELD => $color, PRODUCT_SIZE_DESCRIPTION_FIELD => $size,
            PRODUCT_ITEM_PRICE_FIELD => $price, QUANTITY_FIELD => $quantity, PRODUCT_GROUP_DESCRIPTION_FIELD => $groupDescription);
        set_session_value(SESSION_CART_KEY, $items);
    }
    save_session();
}

function updateQuantityInSession($newQuantity, $id) {
    $items = getItemsInCart();

    for ($count = 0; $count < count($items); $count++) {
        if ($items[$count][PRODUCT_ITEM_ID_FIELD] == $id) {
            $previousQuantity = $items[$count][QUANTITY_FIELD];
            $items[$count][QUANTITY_FIELD] = $newQuantity;
            set_session_value(SESSION_CART_KEY, $items);
        }
    }
    save_session();
    return $previousQuantity;
}

function removeItemFromCart($buttonClickedID) {
    $itemsInCart = getItemsInCart();
    for ($count = 0; $count < count($itemsInCart); $count++) {
        if ($itemsInCart[$count][PRODUCT_ITEM_ID_FIELD] == $buttonClickedID) {
            unset($itemsInCart[$count]);
            $itemsInCart = array_values($itemsInCart);
        }
    }
    set_session_value(SESSION_CART_KEY, $itemsInCart);
    save_session();
    header("Refresh:0");
    exit();
}

function getNumItemsInCart() {
    $itemsInCart = getItemsInCart();
    $numItemsInCart = 0;

    if (!empty($itemsInCart)) {
        foreach ($itemsInCart as $item) {
            $numItemsInCart += $item[QUANTITY_FIELD];
        }
    }
    return $numItemsInCart;
}

function getQuantityOfItem($id) {
    $itemsInCart = getItemsInCart();

    if (!empty($itemsInCart)) {
        foreach ($itemsInCart as $item) {
            if ($item[PRODUCT_ITEM_ID_FIELD] == $id) {
                return $item[QUANTITY_FIELD];
            }
        }
        return 0;
    }
}

function getItemSubtotal($id) {
    $itemsInCart = getItemsInCart();
    $subtotal = 0;

    if (!empty($itemsInCart)) {
        foreach ($itemsInCart as $item) {
            if ($item[PRODUCT_ITEM_ID_FIELD] == $id) {
                $subtotal += $item[PRODUCT_ITEM_PRICE_FIELD] * $item[QUANTITY_FIELD];
            }
        }
    }
    return $subtotal;
}

function getCartTotal() {
    $itemsInCart = getItemsInCart();
    $total = 0;

    if (!empty($itemsInCart)) {
        foreach ($itemsInCart as $item) {
            $total += $item[PRODUCT_ITEM_PRICE_FIELD] * $item[QUANTITY_FIELD];
        }
    }
    return $total;
}
?>