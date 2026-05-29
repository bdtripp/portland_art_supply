<?php
declare(strict_types=1);
namespace PAS;

use PAS\DbConstants;
use PAS\Utilities;
use PAS\PageConstants;

class Cart
{
    /**
     * @return array<int, CartItem>
     */
    public function getItemsInCart(): array {
        $rawItems = Utilities::getSessionValue(PageConstants::SESSION_CART_KEY) ?? [];

        $itemsInCart = [];

        foreach ($rawItems as $item) {
            $itemsInCart[] = new CartItem(
                productItemId: (int) $item[DbConstants::PRODUCT_ITEM_ID_FIELD],
                categoryName: (string) $item[DbConstants::PRODUCT_CATEGORY_NAME_FIELD],
                subcategoryName: (string) $item[DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD],
                groupCode: (string) $item[DbConstants::PRODUCT_GROUP_CODE_FIELD],
                colorName: (string) $item[DbConstants::PRODUCT_COLOR_NAME_FIELD],
                sizeDescription: (string) $item[DbConstants::PRODUCT_SIZE_DESCRIPTION_FIELD],
                price: (float) $item[DbConstants::PRODUCT_ITEM_PRICE_FIELD],
                quantity: (int) $item[DbConstants::QUANTITY_FIELD],
                groupDescription: (string) $item[DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD]
            );
        }

        return $itemsInCart;
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
        $itemsInCart = $this->getItemsInCart();
        $newItem = true;

        // Check if the item already exists in the cart
        foreach ($itemsInCart as $index => $item) {
            if ($item->productItemId === $id) {
                // Replace the existing CartItem with a new one (immutability)
                $itemsInCart[$index] = new CartItem(
                    productItemId: $item->productItemId,
                    categoryName: $item->categoryName,
                    subcategoryName: $item->subcategoryName,
                    groupCode: $item->groupCode,
                    colorName: $item->colorName,
                    sizeDescription: $item->sizeDescription,
                    price: $item->price,
                    quantity: $item->quantity + $quantity,
                    groupDescription: $item->groupDescription
                );

                $newItem = false;
                break;
            }
        }

        if ($newItem) {
            $itemsInCart[] = new CartItem(
                productItemId: $id,
                categoryName: $category,
                subcategoryName: $subcategory,
                groupCode: $groupCode,
                colorName: $color,
                sizeDescription: $size,
                price: $price,
                quantity: $quantity,
                groupDescription: $groupDescription
            );
        }

        Utilities::setSessionValue(PageConstants::SESSION_CART_KEY, $itemsInCart);
        Utilities::saveSession();
    }

    public function updateQuantityInSession(int $newQuantity, int $id): int {
        /** @var array<int, CartItem> $itemsInCart */
        $itemsInCart = $this->getItemsInCart();
        $previousQuantity = 0;

        foreach ($itemsInCart as $index => $item) {
            if ($item->productItemId === $id) {
                $previousQuantity = $item->quantity;
                $itemsInCart[$index] = new CartItem(
                    productItemId: $item->productItemId,
                    categoryName: $item->categoryName,
                    subcategoryName: $item->subcategoryName,
                    groupCode: $item->groupCode,
                    colorName: $item->colorName,
                    sizeDescription: $item->sizeDescription,
                    price: $item->price,
                    quantity: $newQuantity,
                    groupDescription: $item->groupDescription
                );
            }
        }

        Utilities::setSessionValue(PageConstants::SESSION_CART_KEY, $itemsInCart);
        Utilities::saveSession();

        return $previousQuantity;
    }

    public function removeItemFromCart(int $id): void {
        /** @var array<int, CartItem> $itemsInCart */
        $itemsInCart = $this->getItemsInCart();

        foreach ($itemsInCart as $index => $item) {
            if ($item->productItemId === $id) {
                unset($itemsInCart[$index]);
                break; // stop after removing the item
            }
        }

        $itemsInCart = array_values($itemsInCart);

        Utilities::setSessionValue(PageConstants::SESSION_CART_KEY, $itemsInCart);
        Utilities::saveSession();

        header("Refresh:0");
        exit();
    }

    public function getNumItemsInCart(): int {
        $itemsInCart = $this->getItemsInCart();
        $numItemsInCart = 0;

        foreach ($itemsInCart as $item) {
            $numItemsInCart += $item->quantity;
        }

        return $numItemsInCart;
    }

    public function getQuantityOfItem(int $id): int {
        $itemsInCart = $this->getItemsInCart();

        foreach ($itemsInCart as $item) {
            if ($item->productItemId === $id) {
                return $item->quantity;
            }
        }

        return 0;
    }

    public function getItemSubtotal(int $id): float {
        $itemsInCart = $this->getItemsInCart();
        $subtotal = 0;

        foreach ($itemsInCart as $item) {
            if ($item->productItemId === $id) {
                $subtotal += $item->price * $item->quantity;
            }
        }

        return $subtotal;
    }

    public function getCartTotal(): float {
        $itemsInCart = $this->getItemsInCart();
        $total = 0;

        foreach ($itemsInCart as $item) {
            $total += $item->price * $item->quantity;
        }

        return $total;
    }
}
