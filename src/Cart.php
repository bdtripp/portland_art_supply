<?php
namespace PAS;

use PAS\DbConstants;
use PAS\Utilities;
use PAS\PageConstants;

class Cart
{
    public function getItemsInCart() {
        return Utilities::getSessionValue(PageConstants::SESSION_CART_KEY);
    }

    public function addItemToCart($id, $category, $subcategory, $groupCode, $color, $size, $price, $quantity, $groupDescription) {
        $items = $this->getItemsInCart();
        $newItem = true;

        if ($items !== null) {
            //check if the item already exists in the cart
            for ($count = 0; $count < count($items); $count++) {
                if ($items[$count][DbConstants::PRODUCT_ITEM_ID_FIELD] == $id) {
                    $items[$count][DbConstants::QUANTITY_FIELD] += $quantity;
                    $newItem = false;
                    Utilities::setSessionValue(PageConstants::SESSION_CART_KEY, $items);
                }
            }
        }
        
        if ($newItem) {
            $items[] = array(DbConstants::PRODUCT_ITEM_ID_FIELD => $id, DbConstants::PRODUCT_CATEGORY_NAME_FIELD => $category,
                DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD => $subcategory, DbConstants::PRODUCT_GROUP_CODE_FIELD => $groupCode,
                DbConstants::PRODUCT_COLOR_NAME_FIELD => $color, DbConstants::PRODUCT_SIZE_DESCRIPTION_FIELD => $size,
                DbConstants::PRODUCT_ITEM_PRICE_FIELD => $price, DbConstants::QUANTITY_FIELD => $quantity, DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD => $groupDescription);
            Utilities::setSessionValue(PageConstants::SESSION_CART_KEY, $items);
        }
        Utilities::saveSession();
    }

    public function updateQuantityInSession($newQuantity, $id) {
        $items = $this->getItemsInCart();

        for ($count = 0; $count < count($items); $count++) {
            if ($items[$count][DbConstants::PRODUCT_ITEM_ID_FIELD] == $id) {
                $previousQuantity = $items[$count][DbConstants::QUANTITY_FIELD];
                $items[$count][DbConstants::QUANTITY_FIELD] = $newQuantity;
                Utilities::setSessionValue(PageConstants::SESSION_CART_KEY, $items);
            }
        }
        Utilities::saveSession();
        return $previousQuantity;
    }

    public function removeItemFromCart($buttonClickedID) {
        $itemsInCart = $this->getItemsInCart();
        for ($count = 0; $count < count($itemsInCart); $count++) {
            if ($itemsInCart[$count][DbConstants::PRODUCT_ITEM_ID_FIELD] == $buttonClickedID) {
                unset($itemsInCart[$count]);
                $itemsInCart = array_values($itemsInCart);
            }
        }
        Utilities::setSessionValue(PageConstants::SESSION_CART_KEY, $itemsInCart);
        Utilities::saveSession();
        header("Refresh:0");
        exit();
    }

    public function getNumItemsInCart() {
        $itemsInCart = $this->getItemsInCart();
        $numItemsInCart = 0;

        if (!empty($itemsInCart)) {
            foreach ($itemsInCart as $item) {
                $numItemsInCart += $item[DbConstants::QUANTITY_FIELD];
            }
        }
        return $numItemsInCart;
    }

    public function getQuantityOfItem($id) {
        $itemsInCart = $this->getItemsInCart();

        if (!empty($itemsInCart)) {
            foreach ($itemsInCart as $item) {
                if ($item[DbConstants::PRODUCT_ITEM_ID_FIELD] == $id) {
                    return $item[DbConstants::QUANTITY_FIELD];
                }
            }
            return 0;
        }
    }

    public function getItemSubtotal($id) {
        $itemsInCart = $this->getItemsInCart();
        $subtotal = 0;

        if (!empty($itemsInCart)) {
            foreach ($itemsInCart as $item) {
                if ($item[DbConstants::PRODUCT_ITEM_ID_FIELD] == $id) {
                    $subtotal += $item[DbConstants::PRODUCT_ITEM_PRICE_FIELD] * $item[DbConstants::QUANTITY_FIELD];
                }
            }
        }
        return $subtotal;
    }

    public function getCartTotal() {
        $itemsInCart = $this->getItemsInCart();
        $total = 0;

        if (!empty($itemsInCart)) {
            foreach ($itemsInCart as $item) {
                $total += $item[DbConstants::PRODUCT_ITEM_PRICE_FIELD] * $item[DbConstants::QUANTITY_FIELD];
            }
        }
        return $total;
    }
}
