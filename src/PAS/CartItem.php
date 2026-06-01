<?php
declare(strict_types=1);

namespace PAS;

class CartItem
{
    public function __construct(
        public readonly int $productItemId,
        public readonly string $categoryName,
        public readonly string $subcategoryName,
        public readonly string $groupCode,
        public readonly string $groupDescription,
        public readonly string $colorName,
        public readonly string $sizeDescription,
        public readonly float $price,
        public readonly int $quantity
    ) {}

    public function toArray(): array
    {
        return [
            'productItemId'   => $this->productItemId,
            'categoryName'    => $this->categoryName,
            'subcategoryName' => $this->subcategoryName,
            'groupCode'       => $this->groupCode,
            'groupDescription'=> $this->groupDescription,
            'colorName'       => $this->colorName,
            'sizeDescription' => $this->sizeDescription,
            'price'           => $this->price,
            'quantity'        => $this->quantity,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            productItemId:   $data['productItemId'],
            categoryName:    $data['categoryName'],
            subcategoryName: $data['subcategoryName'],
            groupCode:       $data['groupCode'],
            groupDescription:$data['groupDescription'],
            colorName:       $data['colorName'],
            sizeDescription: $data['sizeDescription'],
            price:           $data['price'],
            quantity:        $data['quantity'],
        );
    }
}