<?php
declare(strict_types=1);

namespace PAS\Models;

final class ProductGroup
{
    public function __construct(
        public readonly int $id,
        public readonly string $groupCode,
        public readonly string $description,
        public readonly string $information
    ) {}
}
