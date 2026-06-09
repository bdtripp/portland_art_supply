<?php

declare(strict_types=1);

namespace PAS\Repositories;

use PDO;
use PAS\Config\DbConstants;
use PAS\Infrastructure\Database;
use PAS\Models\User;

final class UserRepository
{
    public function __construct(
        private Database $db,
    ) {
    }

    public function findByUsername(string $username): ?User
    {
        $stmt = $this->db->getConnection()->prepare("
            SELECT *
            FROM " . DbConstants::USERS_TABLE . "
            WHERE " . DbConstants::USERS_USERNAME_FIELD . " = :username
            LIMIT 1
        ");

        $stmt->execute([
            ':username' => $username,
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            return null;
        }

        return new User(
            id: (int)$row[DbConstants::USER_ID_FIELD],
            username: $row[DbConstants::USERS_USERNAME_FIELD],
            passwordHash: $row[DbConstants::USERS_HASH_FIELD]
        );
    }

    public function createUser(string $username, string $hash): User
    {
        $stmt = $this->db->getConnection()->prepare("
            INSERT INTO " . DbConstants::USERS_TABLE . " (
                " . DbConstants::USERS_USERNAME_FIELD . ",
                " . DbConstants::USERS_HASH_FIELD . "
            ) VALUES (:username, :hash)
        ");

        $stmt->execute([
            ':username' => $username,
            ':hash' => $hash,
        ]);

        $user = $this->findByUsername($username);

        if ($user === null) {
            throw new \RuntimeException("User lookup failed after insert");
        }

        return $user;
    }
}
