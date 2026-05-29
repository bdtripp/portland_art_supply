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
        public readonly string $colorName,
        public readonly string $sizeDescription,
        public readonly float $price,
        public readonly int $quantity,
        public readonly string $groupDescription
    ) {}
}