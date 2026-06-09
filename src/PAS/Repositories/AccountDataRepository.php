<?php

declare(strict_types=1);

namespace PAS\Repositories;

use PDO;
use PAS\Infrastructure\Database;
use PAS\Config\DbConstants;

final class AccountDataRepository
{
    public function __construct(
        private Database $db,
    ) {
    }

    /**
    * @return array{
    *     user_id: int,
    *     session_data: string,
    * }|null
    */
    public function findSessionByUserId(?int $userId): ?array
    {
        if ($userId === null) {
            return null;
        }

        $stmt = $this->db->getConnection()->prepare("
            SELECT *
            FROM " . DbConstants::ACCOUNT_DATA_TABLE . "
            WHERE " . DbConstants::ACCOUNT_DATA_USER_ID_FIELD . " = :userId
            LIMIT 1
        ");

        $stmt->execute([
            ':userId' => $userId,
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row === false ? null : $row;
    }

    public function saveSession(?int $userId, string $sessionData): void
    {
        if ($userId === null) {
            return;
        }

        try {
            $stmt = $this->db->getConnection()->prepare("
                INSERT INTO " . DbConstants::ACCOUNT_DATA_TABLE . " (
                    " . DbConstants::ACCOUNT_DATA_USER_ID_FIELD . ",
                    " . DbConstants::ACCOUNT_DATA_SESSION_DATA_FIELD . "
                ) VALUES (:userId, :sessionData)
                ON DUPLICATE KEY UPDATE
                    " . DbConstants::ACCOUNT_DATA_SESSION_DATA_FIELD . " = :sessionDataDup
            ");

            $stmt->execute([
                ':userId' => $userId,
                ':sessionData' => $sessionData,
                ':sessionDataDup' => $sessionData,
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            error_log("DB error in saveSession: " . $e->getMessage());
        }
    }
}
