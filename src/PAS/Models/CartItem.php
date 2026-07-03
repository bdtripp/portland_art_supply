<?php

declare(strict_types=1);

namespace PAS\Models;

class CartItem
{
    public function __construct(
        public readonly int $id,
        public readonly string $category,
        public readonly string $subcategory,
        public readonly string $groupCode,
        public readonly string $groupName,
        public readonly string $color,
        public readonly string $size,
        public readonly float $price,
        public readonly int $quantity
    ) {
    }

    /**
     * @return array{
     *     id: int,
     *     category: string,
     *     subcategory: string,
     *     groupCode: string,
     *     groupName: string,
     *     color: string,
     *     size: string,
     *     price: float,
     *     quantity: int
     * }
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category,
            'subcategory' => $this->subcategory,
            'groupCode' => $this->groupCode,
            'groupName' => $this->groupName,
            'color' => $this->color,
            'size' => $this->size,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ];
    }

    /**
     * @param array{
     *     id: int,
     *     category: string,
     *     subcategory: string,
     *     groupCode: string,
     *     groupName: string,
     *     color: string,
     *     size: string,
     *     price: float,
     *     quantity: int
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            category: $data['category'],
            subcategory: $data['subcategory'],
            groupCode: $data['groupCode'],
            groupName: $data['groupName'],
            color: $data['color'],
            size: $data['size'],
            price: $data['price'],
            quantity: $data['quantity'],
        );
    }
}
