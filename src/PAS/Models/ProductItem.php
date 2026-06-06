<?php

declare(strict_types=1);

namespace PAS\Models;

final class ProductItem
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $colorName,
        public readonly ?string $sizeDescription,
        public readonly float $price
    ) {
    }
}
