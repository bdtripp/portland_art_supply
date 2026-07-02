<?php

declare(strict_types=1);

namespace PAS\Repositories;

use PDO;
use PAS\Infrastructure\Database;
use PAS\Config\DbConstants;
use PAS\Models\ProductGroup;
use PAS\Models\ProductItem;

final class ProductRepository
{
    public function __construct(
        private Database $db,
    ) {
    }

    /**
     * @return array<int, array{
     *     group: ProductGroup,
     *     category_name: string,
     *     subcategory_name: string
     * }>
     */
    public function getProductGroups(string $category, string $subcategory): array
    {
        $stmt = $this->db->getConnection()->prepare("
            SELECT
                " . DbConstants::PRODUCT_GROUP_ID_FIELD . ",
                " . DbConstants::PRODUCT_GROUP_CODE_FIELD . ",
                " . DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD . ",
                " . DbConstants::PRODUCT_CATEGORY_NAME_FIELD . ",
                " . DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD . "
            FROM " . DbConstants::PRODUCT_GROUP_TABLE . "
            JOIN " . DbConstants::PRODUCT_CATEGORY_TABLE . "
                ON " . DbConstants::PRODUCT_GROUP_TABLE . "." . DbConstants::PRODUCT_GROUP_CATEGORY_ID_FIELD . "
                = " . DbConstants::PRODUCT_CATEGORY_TABLE . "." . DbConstants::PRODUCT_CATEGORY_ID_FIELD . "
            JOIN " . DbConstants::PRODUCT_SUBCATEGORY_TABLE . "
                ON " . DbConstants::PRODUCT_GROUP_TABLE . "." . DbConstants::PRODUCT_GROUP_SUBCATEGORY_ID_FIELD . "
                = " . DbConstants::PRODUCT_SUBCATEGORY_TABLE . "." . DbConstants::PRODUCT_SUBCATEGORY_ID_FIELD . "
            WHERE " . DbConstants::PRODUCT_CATEGORY_NAME_FIELD . " = :category
            AND " . DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD . " = :subcategory;
        ");

        $ucCategory = ucfirst($category);
        $ucSubcategory = ucfirst($subcategory);

        $stmt->bindParam(':category', $ucCategory, PDO::PARAM_STR);
        $stmt->bindParam(':subcategory', $ucSubcategory, PDO::PARAM_STR);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $groups = [];
        foreach ($rows as $row) {
            $groups[] = [
                'group' => new ProductGroup(
                    id: (int)$row[DbConstants::PRODUCT_GROUP_ID_FIELD],
                    groupCode: $row[DbConstants::PRODUCT_GROUP_CODE_FIELD],
                    description: $row[DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD],
                    information: null
                ),
                'category_name' => $row[DbConstants::PRODUCT_CATEGORY_NAME_FIELD],
                'subcategory_name' => $row[DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD]
            ];
        }

        return $groups;
    }

    /**
     * @return ProductGroup|null
     */
    public function getGroupById(int $groupId): ?ProductGroup
    {
        $stmt = $this->db->getConnection()->prepare("
            SELECT
                " . DbConstants::PRODUCT_GROUP_ID_FIELD . ",
                " . DbConstants::PRODUCT_GROUP_CODE_FIELD . ",
                " . DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD . ",
                " . DbConstants::PRODUCT_GROUP_INFORMATION_FIELD . "
            FROM " . DbConstants::PRODUCT_GROUP_TABLE . "
            WHERE " . DbConstants::PRODUCT_GROUP_ID_FIELD . " = :groupId;
        ");

        $stmt->bindParam(':groupId', $groupId, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row === false) {
            return null;
        }

        return new ProductGroup(
            id: (int)$row[DbConstants::PRODUCT_GROUP_ID_FIELD],
            groupCode: $row[DbConstants::PRODUCT_GROUP_CODE_FIELD],
            description: $row[DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD],
            information: $row[DbConstants::PRODUCT_GROUP_INFORMATION_FIELD]
        );
    }

    /**
     * @return ProductItem[]
     */
    public function getItemsByGroupId(int $groupId): array
    {
        $stmt = $this->db->getConnection()->prepare("
            SELECT
                " . DbConstants::PRODUCT_ITEM_ID_FIELD . ",
                " . DbConstants::PRODUCT_COLOR_NAME_FIELD . ",
                " . DbConstants::PRODUCT_SIZE_DESCRIPTION_FIELD . ",
                " . DbConstants::PRODUCT_ITEM_PRICE_FIELD . "
            FROM " . DbConstants::PRODUCT_ITEM_TABLE . "
            LEFT JOIN " . DbConstants::PRODUCT_COLOR_TABLE . "
                ON " . DbConstants::PRODUCT_ITEM_TABLE . "." . DbConstants::PRODUCT_ITEM_COLOR_ID_FIELD . "
                = " . DbConstants::PRODUCT_COLOR_TABLE . "." . DbConstants::PRODUCT_COLOR_ID_FIELD . "
            LEFT JOIN " . DbConstants::PRODUCT_SIZE_TABLE . "
                ON " . DbConstants::PRODUCT_ITEM_TABLE . "." . DbConstants::PRODUCT_ITEM_SIZE_ID_FIELD . "
                = " . DbConstants::PRODUCT_SIZE_TABLE . "." . DbConstants::PRODUCT_SIZE_ID_FIELD . "
            WHERE " . DbConstants::PRODUCT_ITEM_GROUP_ID_FIELD . " = :groupId;
        ");

        $stmt->bindParam(':groupId', $groupId, PDO::PARAM_INT);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $items = [];
        foreach ($rows as $row) {
            $items[] = new ProductItem(
                id: (int)$row[DbConstants::PRODUCT_ITEM_ID_FIELD],
                colorName: $row[DbConstants::PRODUCT_COLOR_NAME_FIELD],
                sizeDescription: $row[DbConstants::PRODUCT_SIZE_DESCRIPTION_FIELD],
                price: (float)$row[DbConstants::PRODUCT_ITEM_PRICE_FIELD]
            );
        }

        return $items;
    }
}
