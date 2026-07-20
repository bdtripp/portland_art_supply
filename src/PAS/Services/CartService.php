<?php

declare(strict_types=1);

namespace PAS\Services;

use PAS\Models\CartItem;
use PAS\Config\SessionConstants;

/**
 * Handles shopping cart operations
 *
 * The cart is stored in the session and the session is treated as the single
 * source of truth. All methods maintain immutability of CartItem objects by replacing
 * items rather than mutating them in place.
 */
class CartService
{
    public function __construct(
        private SessionManager $sessionManager
    ) {
    }

    /**
     * @return array<int, CartItem>
     */
    public function getCart(): array
    {
        $items = $this->sessionManager->get(SessionConstants::CART_KEY);

        if (!is_array($items)) {
            return [];
        }

        return array_values(
            array_filter($items, fn ($i) => $i instanceof CartItem)
        );
    }

    /**
     * @param array<int, CartItem> $items
     */
    public function setCart(array $items): void
    {
        $this->sessionManager->set(SessionConstants::CART_KEY, $items);
    }

    /**
     * @param array<int, array{
     *     id: int,
     *     category: string,
     *     subcategory: string,
     *     groupCode: string,
     *     groupName: string,
     *     color: string,
     *     size: string,
     *     price: float,
     *     quantity: int
     * }> $arr
     */
    public function setCartFromArray(array $arr): void
    {
        $items = array_map(fn ($i) => CartItem::fromArray($i), $arr);
        $this->setCart($items);
    }

    /**
     * @return array<int, array{
     *     id: int,
     *     category: string,
     *     subcategory: string,
     *     groupCode: string,
     *     groupName: string,
     *     color: string,
     *     size: string,
     *     price: float,
     *     quantity: int
     * }>
     */
    public function getCartAsArray(): array
    {
        return array_map(fn (CartItem $i) => $i->toArray(), $this->getCart());
    }

    public function addItem(
        int $id,
        string $category,
        string $subcategory,
        string $groupCode,
        string $groupName,
        string $color,
        string $size,
        float $price,
        int $quantity
    ): void {
        /** @var array<int, CartItem> $items */
        $items = $this->getCart();
        $newItem = true;

        // If the item exists, replace it with a new CartItem with updated quantity to maintain immutability
        foreach ($items as $index => $item) {
            if ($item->id === $id) {
                $items[$index] = new CartItem(
                    id: $item->id,
                    category: $item->category,
                    subcategory: $item->subcategory,
                    groupCode: $item->groupCode,
                    groupName: $item->groupName,
                    color: $item->color,
                    size: $item->size,
                    price: $item->price,
                    quantity: $item->quantity + $quantity
                );

                $newItem = false;
                break;
            }
        }

        if ($newItem) {
            $items[] = new CartItem(
                id: $id,
                category: $category,
                subcategory: $subcategory,
                groupCode: $groupCode,
                groupName: $groupName,
                color: $color,
                size: $size,
                price: $price,
                quantity: $quantity
            );
        }

        $this->setCart($items);
        $this->sessionManager->save([
            'cart' => $this->getCartAsArray(),
        ]);
    }

    public function setItemQuantity(int $newQuantity, int $id): int
    {
        /** @var array<int, CartItem> $items */
        $items = $this->getCart();
        $previousQuantity = 0;

        // If the item exists, replace it with a new CartItem with updated quantity to maintain immutability
        foreach ($items as $index => $item) {
            if ($item->id === $id) {
                $previousQuantity = $item->quantity;
                $items[$index] = new CartItem(
                    id: $item->id,
                    category: $item->category,
                    subcategory: $item->subcategory,
                    groupCode: $item->groupCode,
                    groupName: $item->groupName,
                    color: $item->color,
                    size: $item->size,
                    price: $item->price,
                    quantity: $newQuantity
                );
            }
        }

        $this->setCart($items);
        $this->sessionManager->save([
            'cart' => $this->getCartAsArray(),
        ]);

        return $previousQuantity;
    }

    public function removeItem(int $id): void
    {
        /** @var array<int, CartItem> $items */
        $items = $this->getCart();

        foreach ($items as $index => $item) {
            if ($item->id === $id) {
                unset($items[$index]);
                break;
            }
        }

        $items = array_values($items);

        $this->setCart($items);
        $this->sessionManager->save([
            'cart' => $this->getCartAsArray(),
        ]);
    }

    public function getTotalQuantity(): int
    {
        $items = $this->getCart();
        $total = 0;

        foreach ($items as $item) {
            $total += $item->quantity;
        }

        return $total;
    }

    public function getItemQuantity(int $id): int
    {
        $items = $this->getCart();

        foreach ($items as $item) {
            if ($item->id === $id) {
                return $item->quantity;
            }
        }

        return 0;
    }

    public function getSubtotal(int $id): float
    {
        foreach ($this->getCart() as $item) {
            if ($item->id === $id) {
                return $item->price * $item->quantity;
            }
        }

        return 0.0;
    }

    public function getTotal(): float
    {
        $items = $this->getCart();
        $total = 0;

        foreach ($items as $item) {
            $total += $item->price * $item->quantity;
        }

        return $total;
    }
}
