<?php
declare(strict_types=1);
namespace PAS;

use PAS\Utilities;
use PAS\Models\CartItem;

class Cart
{
    public function addItemToCart(
        int $id,
        string $category,
        string $subcategory,
        string $groupCode,
        string $groupDescription,
        string $color,
        string $size,
        float $price,
        int $quantity
    ): void {
        /** @var array<int, CartItem> $itemsInCart */
        $itemsInCart = Utilities::getCartItems();
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
                    groupDescription: $item->groupDescription,
                    colorName: $item->colorName,
                    sizeDescription: $item->sizeDescription,
                    price: $item->price,
                    quantity: $item->quantity + $quantity
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
                groupDescription: $groupDescription,
                colorName: $color,
                sizeDescription: $size,
                price: $price,
                quantity: $quantity
            );
        }

        Utilities::setCartItems($itemsInCart);
    }

    public function updateQuantityInSession(int $newQuantity, int $id): int {
        /** @var array<int, CartItem> $itemsInCart */
        $itemsInCart = Utilities::getCartItems();
        $previousQuantity = 0;

        foreach ($itemsInCart as $index => $item) {
            if ($item->productItemId === $id) {
                $previousQuantity = $item->quantity;
                $itemsInCart[$index] = new CartItem(
                    productItemId: $item->productItemId,
                    categoryName: $item->categoryName,
                    subcategoryName: $item->subcategoryName,
                    groupCode: $item->groupCode,
                    groupDescription: $item->groupDescription,
                    colorName: $item->colorName,
                    sizeDescription: $item->sizeDescription,
                    price: $item->price,
                    quantity: $newQuantity
                );
            }
        }

        Utilities::setCartItems($itemsInCart);

        return $previousQuantity;
    }

    public function removeItemFromCart(int $id): void {
        /** @var array<int, CartItem> $itemsInCart */
        $itemsInCart = Utilities::getCartItems();

        foreach ($itemsInCart as $index => $item) {
            if ($item->productItemId === $id) {
                unset($itemsInCart[$index]);
                break; // stop after removing the item
            }
        }

        $itemsInCart = array_values($itemsInCart);

        Utilities::setCartItems($itemsInCart);

        header("Refresh:0");
        exit();
    }

    public function getNumItemsInCart(): int {
        $itemsInCart = Utilities::getCartItems();
        $numItemsInCart = 0;

        foreach ($itemsInCart as $item) {
            $numItemsInCart += $item->quantity;
        }

        return $numItemsInCart;
    }

    public function getQuantityOfItem(int $id): int {
        $itemsInCart = Utilities::getCartItems();

        foreach ($itemsInCart as $item) {
            if ($item->productItemId === $id) {
                return $item->quantity;
            }
        }

        return 0;
    }

    public function getItemSubtotal(int $id): float {
        $itemsInCart = Utilities::getCartItems();
        $subtotal = 0;

        foreach ($itemsInCart as $item) {
            if ($item->productItemId === $id) {
                $subtotal += $item->price * $item->quantity;
            }
        }

        return $subtotal;
    }

    public function getCartTotal(): float {
        $itemsInCart = Utilities::getCartItems();
        $total = 0;

        foreach ($itemsInCart as $item) {
            $total += $item->price * $item->quantity;
        }

        return $total;
    }
}
