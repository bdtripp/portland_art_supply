<?php

namespace PAS\View;

use PAS\Models\CartItem;
use PAS\Services\CartService;
use PAS\Config\PageConstants;

class CartUi
{
    private const QUANTITY_MIN = 1;
    private const QUANTITY_MAX = 50;
    public function __construct(
        private CartService $cartService
    ) {
    }

    public function shoppingCart(): void
    {
        $itemsInCart = $this->cartService->getCart();

        echo '<main>' . "\n";
        echo '    <section id="cart_items">' . "\n";
        echo '        <h2>' . 'Shopping Cart' . '</h2>' . "\n";
        echo '            <div id="' . PageConstants::CART_ITEMS_WRAPPER_ID . '">' . "\n";
        if (!empty($itemsInCart)) {
            $this->showItemsInCart($itemsInCart);
            echo '        </div>' . "\n";
            echo '        <p id="' . PageConstants::TOTAL_DISPLAY_ID . '">Total: <span class="' . PageConstants::PRICE_DISPLAY_CLASS . '">$' . number_format($this->cartService->getCartTotal(), 2) . '</span></p>' . "\n";
            echo '        <input id="' . PageConstants::CHECKOUT_BUTTON_ID . '" type="button" value="Checkout">' . "\n";
            echo '        <p class="checkout-disabled-note">Checkout disabled.<br>This is a demo project.</p>' . "\n";
        } else {
            echo '        <p id="' . PageConstants::EMPTY_CART_MESSAGE_ID . '">There are no items currently in the cart</p>' . "\n";
        }
        echo '    </section>' . "\n";
        echo '</main>' . "\n\n";
    }

    /**
     * @param array<int, CartItem> $itemsInCart
     */
    public function showItemsInCart(array $itemsInCart): void
    {
        foreach ($itemsInCart as $item) {
            $id = $item->productItemId;
            $groupDescription = $item->groupDescription;
            $categoryName = $item->categoryName;
            $subcategoryName = $item->subcategoryName;
            $groupCode = $item->groupCode;
            $color = $item->colorName;
            $size = $item->sizeDescription;
            $price = $item->price;
            $quantity = $item->quantity;

            echo '        <div id="product_id_' . $id . '_div" class="' . PageConstants::CART_ITEM_CLASS . ' ' . PageConstants::CARD_CLASS . '">' . "\n";
            $this->displayItemImage(
                $categoryName,
                $subcategoryName,
                $groupCode,
                $color,
                $size
            );
            echo '            <div class="' . PageConstants::CART_ITEM_INFO_CLASS . '">' . "\n";
            echo '                <div class="' . PageConstants::CART_ITEM_SPECS_CLASS . '">' . "\n";
            echo '                    <p>' . e($groupDescription) . '</p>' . "\n";
            if ($color != 'null') {
                echo '                    <p> Color: ' . e($color) . '</p>' . "\n";
            }
            if ($size != 'null') {
                echo '                    <p> Size: ' . e($size) . '</p>' . "\n";
            }
            echo '                </div>' . "\n";
            echo '                <p class="' . PageConstants::PRICE_DISPLAY_CLASS . '">$' . $price . '</p>' . "\n";
            echo '                    <div class="' . PageConstants::QUANTITY_DIV_CLASS . '">'. "\n";
            echo '                        <label for="quantity_product_id_' . $id . '"> Quantity: </label>' . "\n";
            echo '                        <select id="quantity_product_id_' . $id .
                '" onchange="onCartPageQuantityChanged(this.id, ' . $id . ')">' . "\n";
            for ($count = self::QUANTITY_MIN; $count <= self::QUANTITY_MAX; $count++) {
                if ($count == $quantity) {
                    echo '                            <option value="' . $count . '" selected="' . $quantity . '">' . $count . '</option>' . "\n";
                } else {
                    echo '                            <option value="' . $count . '">' . $count . '</option>' , "\n";
                }
            }
            echo '                        </select>' . "\n";
            echo '                    </div>' . "\n";
            echo '                    <p id="' . "subtotal_product_" . $id . '" class="' . PageConstants::SUBTOTAL_CLASS . '">Subtotal:' .
                '<span class="' . PageConstants::PRICE_DISPLAY_CLASS . '">$' . number_format($price * $quantity, 2) . '</span></p>' . "\n";
            echo '            </div>' ."\n";
            echo '            <input id="' . $id . '" class="' . PageConstants::REMOVE_BUTTON_CLASS . '" type="button" value="Remove"' .
                ' onclick="onRemoveClicked(this.id,\'shopping_cart.php\')">' . "\n";
            echo '        </div>' . "\n";
        }
    }

    public function displayItemImage(string $category, string $subcategory, string $groupCode, string $color, string $size): void
    {
        if ($size != 'null' || $color != 'null') {
            $groupCode .= '-';
        }
        if ($size != 'null'  && $color != 'null') {
            $color .= '-';
        }
        if ($color == 'null') {
            $color = '';
        }
        if ($size == 'null') {
            $size = '';
        }

        $colorSanitized = preg_replace('/&quot+;|#+|\.|"+/', '_', $color);
        $colorSanitized = $colorSanitized ?? '';
        $colorSanitized = strtolower($colorSanitized);
        $colorSanitized = preg_replace('/\s+(?=[^()]*(\(|$))/', '-', $colorSanitized);
        $colorSanitized = $colorSanitized ?? '';

        $sizeSanitized = preg_replace('/&quot+;|#+|\.|"+/', '_', $size);
        $sizeSanitized = $sizeSanitized ?? '';
        $sizeSanitized = strtolower($sizeSanitized);
        $sizeSanitized = preg_replace('/\s+(?=[^()]*(\(|$))/', '-', $sizeSanitized);
        $sizeSanitized = $sizeSanitized ?? '';
        $sizeSanitized = preg_replace('/\//', '_', $sizeSanitized);
        $sizeSanitized = $sizeSanitized ?? '';

        echo '            <img src="' . PageConstants::IMAGE_FOLDER
                            . rawurlencode($category) . '/'
                            . rawurlencode($subcategory) . '/'
                            . rawurlencode($groupCode)
                            . rawurlencode($colorSanitized)
                            . rawurlencode($sizeSanitized)
                            . '.jpg">' . "\n";
    }
}
