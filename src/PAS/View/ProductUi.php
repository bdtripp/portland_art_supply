<?php

namespace PAS\View;

use PAS\Models\ProductGroup;
use PAS\Config\PageConstants;
use PAS\Config\DbConstants;

class ProductUi
{
    public function __construct(
    ) {
    }

    /**
     * @param array<int, array{
     *     group: ProductGroup,
     *     category_name: string,
     *     subcategory_name: string
     * }> $products
     */
    public function groupGrid(array $products): void
    {
        echo '<main>' . "\n";
        echo '    <h2 class="' . PageConstants::LARGE_H2 . '">' . $products[0]['subcategory_name'] . '</h2>' . "\n\n";
        echo '    <section id="' . PageConstants::PRODUCT_GROUPS_ID . '">' . "\n";

        foreach ($products as $product) {
            $this->showProductGroups($product);
        }

        echo '    </section>' . "\n";
        echo '</main>' . "\n\n";
    }

    /**
     * @param array{
     *     group: ProductGroup,
     *     category_name: string,
     *     subcategory_name: string
     * } $product
     */
    public function showProductGroups(array $product): void
    {
        $group = $product['group'];
        $category = $product['category_name'];
        $subcategory = $product['subcategory_name'];

        $hrefString = 'href="' . PageConstants::PRODUCT_ITEMS_PAGE . '?' .
            DbConstants::PRODUCT_GROUP_ID_FIELD . '=' . urlencode((string)$group->id) .
            '&' . DbConstants::PRODUCT_CATEGORY_NAME_FIELD . '=' . urlencode($category) .
            '&' . DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD . '=' . urlencode($subcategory) .
            '&' . DbConstants::PRODUCT_GROUP_CODE_FIELD . '=' . urlencode($group->groupCode) . '"';

        echo '            <div class="' . PageConstants::PRODUCT_GROUP_CLASS . ' ' . PageConstants::CARD_CLASS . '">' . "\n";
        echo '                <a class="' . PageConstants::GROUP_DESCRIPTION_TEXT_CLASS . '" ' . $hrefString . '>' . "\n";
        echo '                     ' . $group->description . '</a>' . "\n";
        echo '                <a ' . $hrefString . '>' . "\n";
        echo '                    <img src="' . PageConstants::IMAGE_FOLDER . $category . '/' .
            $subcategory . '/' . $group->groupCode . '.jpg">' . "\n";
        echo '                </a>' . "\n";
        echo '            </div>' . "\n\n";
    }

    public function itemDetail(ProductGroup $productGroup, string $categoryName, string $subCategoryName): void
    {
        echo '<main>' . "\n";
        echo '    <h2>' . $productGroup->description . '</h2>' . "\n";
        echo '    <section id="' . PageConstants::ITEM_WRAPPER_ID . '">' . "\n";
        echo '        <p id="' . PageConstants::GROUP_INFORMATION_ID . '">' . $productGroup->information . '</p>' . "\n";
        echo '        <div id="' . PageConstants::IMAGE_WRAPPER_ID . '" class="' . PageConstants::CARD_CLASS . '">' . "\n";
        echo '            <img id=' . PageConstants::PRODUCT_ITEM_IMAGE_ID . ' src="' . PageConstants::IMAGE_FOLDER . $categoryName . '/' .
            $subCategoryName . '/' . $productGroup->groupCode . '.jpg">' . "\n";
        echo '        </div>' . "\n";
        echo '        <div id="' . PageConstants::DETAILS_WRAPPER_ID . '" class="' . PageConstants::CARD_CLASS .  '">' . "\n";
        echo '            <div id="' . PageConstants::ITEM_DETAILS_DIV . '">' . "\n";
        echo '                <div id="' . PageConstants::ITEM_OPTIONS_DIV . '">' . "\n";
        echo '                    <div id="' . PageConstants::DROP_DOWN_WRAPPER_ID . '">' . "\n";
        echo '                    </div>' . "\n";
        echo '                </div>' . "\n";
        echo '            </div>' . "\n";
        echo '        </div>' ."\n";
        echo '    </section>' ."\n";
        echo '</main>' . "\n\n";
    }
}
