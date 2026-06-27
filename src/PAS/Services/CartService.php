<?php

declare(strict_types=1);

namespace PAS\Services;

use PAS\Models\CartItem;
use PAS\Config\SessionConstants;

class CartService
{
    public function __construct(
        private SessionService $sessionService
    ) {
    }

    /**
     * @return array<int, CartItem>
     */
    public function getCart(): array
    {
        $items = $this->sessionService->get(SessionConstants::CART_KEY);

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
        $this->sessionService->set(SessionConstants::CART_KEY, $items);
    }

    /**
     * @param array<int, array{
     *     productItemId: int,
     *     categoryName: string,
     *     subcategoryName: string,
     *     groupCode: string,
     *     groupDescription: string,
     *     colorName: string,
     *     sizeDescription: string,
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
     *     productItemId: int,
     *     categoryName: string,
     *     subcategoryName: string,
     *     groupCode: string,
     *     groupDescription: string,
     *     colorName: string,
     *     sizeDescription: string,
     *     price: float,
     *     quantity: int
     * }>
     */
    public function getCartAsArray(): array
    {
        return array_map(fn (CartItem $i) => $i->toArray(), $this->getCart());
    }

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
        $itemsInCart = $this->getCart();
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

        $this->setCart($itemsInCart);
        $this->sessionService->save([
            'cart' => $this->getCartAsArray(),
        ]);
    }

    public function updateQuantityInSession(int $newQuantity, int $id): int
    {
        /** @var array<int, CartItem> $itemsInCart */
        $itemsInCart = $this->getCart();
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

        $this->setCart($itemsInCart);
        $this->sessionService->save([
            'cart' => $this->getCartAsArray(),
        ]);

        return $previousQuantity;
    }

    public function removeItemFromCart(int $id): void
    {
        /** @var array<int, CartItem> $itemsInCart */
        $itemsInCart = $this->getCart();

        foreach ($itemsInCart as $index => $item) {
            if ($item->productItemId === $id) {
                unset($itemsInCart[$index]);
                break;
            }
        }

        $itemsInCart = array_values($itemsInCart);

        $this->setCart($itemsInCart);
        $this->sessionService->save([
            'cart' => $this->getCartAsArray(),
        ]);

        header("Refresh:0");
        exit();
    }

    public function getNumItemsInCart(): int
    {
        $itemsInCart = $this->getCart();
        $numItemsInCart = 0;

        foreach ($itemsInCart as $item) {
            $numItemsInCart += $item->quantity;
        }

        return $numItemsInCart;
    }

    public function getQuantityOfItem(int $id): int
    {
        $itemsInCart = $this->getCart();

        foreach ($itemsInCart as $item) {
            if ($item->productItemId === $id) {
                return $item->quantity;
            }
        }

        return 0;
    }

    public function getItemSubtotal(int $id): float
    {
        $itemsInCart = $this->getCart();
        $subtotal = 0;

        foreach ($itemsInCart as $item) {
            if ($item->productItemId === $id) {
                $subtotal += $item->price * $item->quantity;
            }
        }

        return $subtotal;
    }

    public function getCartTotal(): float
    {
        $itemsInCart = $this->getCart();
        $total = 0;

        foreach ($itemsInCart as $item) {
            $total += $item->price * $item->quantity;
        }

        return $total;
    }
}
