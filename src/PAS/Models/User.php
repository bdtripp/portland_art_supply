<?php

declare(strict_types=1);

namespace PAS\Models;

final class User
{
    public function __construct(
        public readonly int $id,
        public readonly string $username,
        public readonly string $passwordHash
    ) {
    }
}
