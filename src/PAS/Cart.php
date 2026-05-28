<?php
declare(strict_types=1);
namespace PAS;

use PAS\DbConstants;
use PAS\Utilities;
use PAS\PageConstants;

/**
 * @phpstan-type CartItem array{
 *     product_item_id: int,
 *     category_name: string,
 *     subcategory_name: string,
 *     group_code: string,
 *     color_name: string,
 *     size_description: string,
 *     price: float,
 *     Quantity: int,
 *     group_description: string
 * }
 */
class Cart
{
    /**
     * @return array<int, CartItem>
     */
    public function getItemsInCart(): array {
        return Utilities::getSessionValue(PageConstants::SESSION_CART_KEY) ?? [];
    }

    public function addItemToCart(
        int $id, 
        string $category, 
        string $subcategory, 
        string $groupCode, 
        string $color, 
        string $size, 
        float $price, 
        int $quantity, 
        string $groupDescription
        ): void {
        /** @var array<int, CartItem> $items */
        $items = $this->getItemsInCart();
        $newItem = true;

        //check if the item already exists in the cart
        for ($count = 0; $count < count($items); $count++) {
            if ((int) $items[$count][DbConstants::PRODUCT_ITEM_ID_FIELD] === $id) {
                $items[$count][DbConstants::QUANTITY_FIELD] = (int) $items[$count][DbConstants::QUANTITY_FIELD] + $quantity;
                $newItem = false;
                Utilities::setSessionValue(PageConstants::SESSION_CART_KEY, $items);
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

    public function updateQuantityInSession(int $newQuantity, int $id): int {
        /** @var array<int, CartItem> $items */
        $items = $this->getItemsInCart();
        $previousQuantity = 0;

        for ($count = 0; $count < count($items); $count++) {
            if ((int) $items[$count][DbConstants::PRODUCT_ITEM_ID_FIELD] === $id) {
                $previousQuantity = (int) $items[$count][DbConstants::QUANTITY_FIELD];
                $items[$count][DbConstants::QUANTITY_FIELD] = $newQuantity;
                Utilities::setSessionValue(PageConstants::SESSION_CART_KEY, $items);
            }
        }
        Utilities::saveSession();
        return $previousQuantity;
    }

    public function removeItemFromCart(int $id): void {
        /** @var array<int, CartItem> $itemsInCart */
        $itemsInCart = $this->getItemsInCart();
        for ($count = 0; $count < count($itemsInCart); $count++) {
            if ((int) $itemsInCart[$count][DbConstants::PRODUCT_ITEM_ID_FIELD] === $id) {
                unset($itemsInCart[$count]);
                $itemsInCart = array_values($itemsInCart);
            }
        }
        Utilities::setSessionValue(PageConstants::SESSION_CART_KEY, $itemsInCart);
        Utilities::saveSession();
        header("Refresh:0");
        exit();
    }

    public function getNumItemsInCart(): int {
        $itemsInCart = $this->getItemsInCart();
        $numItemsInCart = 0;

        foreach ($itemsInCart as $item) {
            $numItemsInCart += (int) $item[DbConstants::QUANTITY_FIELD];
        }
        return $numItemsInCart;
    }

    public function getQuantityOfItem(int $id): int {
        $itemsInCart = $this->getItemsInCart();

        foreach ($itemsInCart as $item) {
            if ((int) $item[DbConstants::PRODUCT_ITEM_ID_FIELD] === $id) {
                return (int) $item[DbConstants::QUANTITY_FIELD];
            }
        }
        return 0;
    }

    public function getItemSubtotal(int $id): float {
        $itemsInCart = $this->getItemsInCart();
        $subtotal = 0;

        foreach ($itemsInCart as $item) {
            if ((int) $item[DbConstants::PRODUCT_ITEM_ID_FIELD] === $id) {
                $subtotal += (float) $item[DbConstants::PRODUCT_ITEM_PRICE_FIELD] * (int) $item[DbConstants::QUANTITY_FIELD];
            }
        }
        return $subtotal;
    }

    public function getCartTotal(): float {
        $itemsInCart = $this->getItemsInCart();
        $total = 0;

        foreach ($itemsInCart as $item) {
            $total += (float) $item[DbConstants::PRODUCT_ITEM_PRICE_FIELD] * (int) $item[DbConstants::QUANTITY_FIELD];
        }
        return $total;
    }
}
