<?php

declare(strict_types=1);

namespace PAS\Repositories;

use PDO;
use PAS\Infrastructure\Database;
use PAS\Config\DbConstants;

final class CategoryRepository
{
    public function __construct(
        private Database $db,
    ) {
    }

    /**
     * @return array<int, array{
     *     category_id: int,
     *     category_name: string
     * }>
     */
    public function lookupCategories(): array
    {
        $stmt = $this->db->getConnection()->query("
            SELECT
                " . DbConstants::PRODUCT_CATEGORY_ID_FIELD . ",
                " . DbConstants::PRODUCT_CATEGORY_NAME_FIELD . "
            FROM " . DbConstants::PRODUCT_CATEGORY_TABLE . ";
        ");

        if ($stmt === false) {
            return [];
        }

        /** @var array<int, array{category_id: int, category_name: string}> */
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array<int, array{
     *      subcategory_name: string
     * }>
     */
    public function lookupSubcategories(int $categoryId): array
    {
        $stmt = $this->db->getConnection()->prepare("
            SELECT
                " . DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD . "
            FROM " . DbConstants::PRODUCT_SUBCATEGORY_TABLE . "
            WHERE " . DbConstants::PRODUCT_SUBCATEGORY_CATEGORY_ID_FIELD . " = :categoryId;
        ");
        $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
