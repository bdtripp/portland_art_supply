<?php
declare(strict_types=1);
namespace PAS;

class Ui
{
    private const ROWS_PER_COLUMN = 3;
    private const QUANTITY_MIN = 1;
    private const QUANTITY_MAX = 50;
    private Database $db;
    private Cart $cart;

    public function __construct()
    {
        $this->db = new Database();
         $this->cart = new Cart();
    }

    public function showHeaderContent(string $categoryName): void {
        if (isset($_SESSION[PageConstants::SESSION_USER_ID_KEY])) {
            $loginHref = PageConstants::LOGOUT_PAGE;
            $username = Utilities::getSessionValue(PageConstants::SESSION_USERNAME_KEY);
            $iconID = PageConstants::LOGOUT_ICON_ID;
            $iconSrc = 'logout_icon.png';
        } else {
            $loginHref = PageConstants::LOGIN_PAGE;
            $username = '';
            $iconID = PageConstants::LOGIN_ICON_ID;
            $iconSrc = 'login_icon.png';
        }

        echo '<header>' . "\n\n";
        echo '    <!-- collapsable menu -->';
        echo '    <input class="' . PageConstants::MENU_BUTTON_CLASS . '" type="checkbox"' . ' ' . 'id="' . PageConstants::MENU_BUTTON_CLASS . '" />'  . "\n";
        echo '    <label class="' . PageConstants::MENU_ICON_CLASS . '" for="' . PageConstants::MENU_BUTTON_CLASS . '"><span class="' .
            PageConstants::NAVIGATION_ICON_CLASS . '"></span></label>' . "\n\n";
        echo '    <h1 id="' . PageConstants::WRAP_PAS . '">Portland<br>Art Supply</h1>' . "\n\n";
        echo '    <h1 id="' . PageConstants::NO_WRAP_PAS . '">Portland Art Supply</h1>' . "\n\n";
        echo '    <ul class="' . PageConstants::HEADER_LINKS_CLASS . '">' . "\n";
        echo '        <li>' . "\n";
        echo '            <a class="' . PageConstants::SHOPPING_CART_ICON_CLASS . '" href="' . PageConstants::SHOPPING_CART_PAGE . '">' . "\n";
        echo '                <img src="' . PageConstants::IMAGE_FOLDER . PageConstants::SHOPPING_CART_IMAGE . '" alt="' . PageConstants::SHOPPING_CART_IMAGE_ALT . '">' . "\n";
        echo '                <p id="' . PageConstants::CART_COUNT_DISPLAY_ID . '">' . $this->cart->getNumItemsInCart() . '</p>' . "\n";
        echo '            </a>' . "\n";
        echo '        </li>' . "\n";
        echo '        <li>' . "\n";
        echo '            <a id="' . PageConstants::USERNAME_DISPLAY_ID . '">'. $username . '</a>' . "\n";
        echo '        </li>' . "\n";
        echo '        <li>' . "\n";
        echo '            <a id="' . PageConstants::LOGIN_LINK_ID . '" href="' . $loginHref . '">' . "\n";
        echo '                <img id="' . $iconID . '" src="' . PageConstants::IMAGE_FOLDER . $iconSrc . '">' . "\n";
        echo '            </a>' . "\n";
        echo '        </li>' . "\n";
        echo '    </ul>' . "\n\n";
        echo '    <nav>' . "\n\n";
        echo '        <ul class="' . PageConstants::MENU_CLASS . '">' . "\n";
        $this->generateNavList($categoryName);
        echo '        </ul>' . "\n\n";
        echo '    </nav>' . "\n\n";

        echo '</header>' . "\n\n";
    }

    public function generateNavList(string $activePage): void {
        $categories = $this->db->lookupCategories();

        echo '            <li><a ' . Utilities::checkCurrentPage(PageConstants::HOME_PAGE) . 'Home</a></li>' . "\n";
        foreach($categories as $category) {
            $categoryID = $category[DbConstants::PRODUCT_CATEGORY_ID_FIELD];
            $categoryName = $category[DbConstants::PRODUCT_CATEGORY_NAME_FIELD];
            $href = PageConstants::SUBCATEGORIES_PAGE . '?' . DbConstants::PRODUCT_CATEGORY_ID_FIELD . '=' .
                $categoryID . '&' . DbConstants::PRODUCT_CATEGORY_NAME_FIELD . '=' .
                $categoryName;

                echo '            <li>' . "\n";
                echo '                <button 
                                        class="expand_btn"
                                        aria-expanded="false" 
                                        aria-haspopup="true" 
                                        aria-controls="' . lcfirst($categoryName) . '_menu"
                                    >' . $categoryName . "\n";
                echo '                    <span class="arrow" aria-hidden="true">▼</span>' . "\n";
                echo '                </button>' . "\n";
                $this->showSubcategoryDropdown($category);
                echo '            </li>' . "\n";
        }
        echo '            <li><a ' . Utilities::checkCurrentPage(PageConstants::ABOUT_PAGE) . 'About</a></li>' . "\n";
    }

    public function showSubcategoryDropdown(array $category): void {
        $categoryID = $category[DbConstants::PRODUCT_CATEGORY_ID_FIELD];
        $categoryName = $category[DbConstants::PRODUCT_CATEGORY_NAME_FIELD];
        $subcategories = $this->db->lookupSubcategories($categoryID);

        echo '                <ul id="' . lcfirst($categoryName) . '_menu" class="dropdown">' . "\n";
        foreach ($subcategories as $subcategory) {
            $subcategoryName = $subcategory[DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD];

            echo '                    <li>
                                        <a href="' . PageConstants::GROUP_PRODUCTS_PAGE . 
                                            "?" . DbConstants::PRODUCT_CATEGORY_NAME_FIELD . "=" . urlencode($categoryName) . 
                                            "&" . DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD . "=" . urlencode($subcategoryName) . 
                                            '" ' . Utilities::checkCurrentSubcat(DbConstants::PRODUCT_CATEGORY_NAME_FIELD, $categoryName, DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD, $subcategoryName) . 
                                        '>' . ucfirst($subcategoryName) . 
                                        '</a>
                                    </li>'; 
        }
        echo '                </ul>' . "\n";
    }

    public function showGroupContent(array $products): void {
        echo '<main>' . "\n";
        echo '    <h2 class="' . PageConstants::LARGE_H2 . '">' . $products[0][DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD] . '</h2>' . "\n\n";
        echo '    <section id="' . PageConstants::PRODUCT_GROUPS_ID . '">' . "\n";
        for ($i = 0; $i < count($products); $i++) {
            $this->showProductGroups($products[$i]);
        }
        echo '    </section>' . "\n";
        echo '</main>' . "\n\n";
    }

    public function showProductGroups(array $product): void {
        $hrefString = 'href="' . PageConstants::PRODUCT_ITEMS_PAGE . '?' . DbConstants::PRODUCT_GROUP_ID_FIELD . '=' . urlencode((string) $product[DbConstants::PRODUCT_GROUP_ID_FIELD]);
        $hrefString .= '&' . DbConstants::PRODUCT_CATEGORY_NAME_FIELD . '=' . urlencode($product[DbConstants::PRODUCT_CATEGORY_NAME_FIELD]);
        $hrefString .= '&' . DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD . '=' . urlencode($product[DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD]);
        $hrefString .= '&' . DbConstants::PRODUCT_GROUP_CODE_FIELD . '=' . urlencode($product[DbConstants::PRODUCT_GROUP_CODE_FIELD]) . '"';
        echo '            <div class="' . PageConstants::PRODUCT_GROUP_CLASS . ' ' . PageConstants::CARD_CLASS . '">' . "\n";
        echo '                <a class="' . PageConstants::GROUP_DESCRIPTION_TEXT_CLASS . '" ' . "\n";
        echo '                     ' . $hrefString . '>' . "\n";
        echo '                     ' . $product[DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD] . '</a>' . "\n";
        echo '                <a ' . $hrefString . '>' . "\n";
        echo '                    <img src="' . PageConstants::IMAGE_FOLDER . $product[DbConstants::PRODUCT_CATEGORY_NAME_FIELD] . '/' .
            $product[DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD]
            . '/' . $product[DbConstants::PRODUCT_GROUP_CODE_FIELD] . '.jpg">' . "\n";
        echo '                </a>' . "\n";
        echo '            </div>' . "\n\n";
    }

    public function showItemContent(array $productGroup, string $categoryName, string $subCategoryName): void {
        echo '<main>' . "\n";
        echo '    <h2>' . $productGroup[DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD] . '</h2>' . "\n";
        echo '    <section id="' . PageConstants::ITEM_WRAPPER_ID . '">' . "\n";
        echo '        <p id="' . PageConstants::GROUP_INFORMATION_ID . '">' . $productGroup[DbConstants::PRODUCT_GROUP_INFORMATION_FIELD] . '</p>' . "\n";
        echo '        <div id="' . PageConstants::IMAGE_WRAPPER_ID . '" class="' . PageConstants::CARD_CLASS . '">' . "\n";
        echo '            <img id=' . PageConstants::PRODUCT_ITEM_IMAGE_ID . ' src="' . PageConstants::IMAGE_FOLDER . $categoryName . '/' .
            $subCategoryName . '/' . $productGroup[DbConstants::PRODUCT_GROUP_CODE_FIELD] . '.jpg">' . "\n";
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

    public function showShoppingCartContent(): void {
        $itemsInCart = Utilities::getSessionValue(PageConstants::SESSION_CART_KEY);

        echo '<main>' . "\n";
        echo '    <section id="cart_items">' . "\n";
        echo '        <h2>' . 'Shopping Cart' . '</h2>' . "\n";
        echo '            <div id="' . PageConstants::CART_ITEMS_WRAPPER_ID . '">' . "\n";
        if (!empty($itemsInCart)) {
            $this->showItemsInCart($itemsInCart);
            echo '        </div>' . "\n";
            echo '        <p id="' . PageConstants::TOTAL_DISPLAY_ID . '">Total: <span class="' . PageConstants::PRICE_DISPLAY_CLASS . '">$' . number_format($this->cart->getCartTotal(), 2) . '</span></p>' . "\n";
            echo '        <input id="' . PageConstants::CHECKOUT_BUTTON_ID . '" type="button" value="Checkout">' . "\n";
        } else {
            echo '        <p id="' . PageConstants::EMPTY_CART_MESSAGE . '">There are no items currently in the cart</p>' . "\n";
        }
        echo '    </section>' . "\n";
        echo '</main>' . "\n\n";
    }

    public function showItemsInCart(array $itemsInCart): void {
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
            $this->displayItemImage($categoryName, $subcategoryName,
                $groupCode, $color,
                $size);
            echo '            <div class="' . PageConstants::CART_ITEM_INFO_CLASS . '">' . "\n";
            echo '                <div class="' . PageConstants::CART_ITEM_SPECS_CLASS . '">' . "\n";
            echo '                    <p>' . $groupDescription . '</p>' . "\n";
            if ($color != 'null') {
                echo '                    <p> Color: ' . $color . '</p>' . "\n";
            }
            if ($size != 'null') {
                echo '                    <p> Size: ' . $size . '</p>' . "\n";
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

    public function displayItemImage(string $category, string $subcategory, string $groupCode, string $color, string $size): void {
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

        $color = strtolower(preg_replace('/&quot+;|#+|\.|"+/', '_', $color));
        $color = preg_replace('/\s+(?=[^()]*(\(|$))/', '-', $color);

        $size = strtolower(preg_replace('/&quot+;|#+|\.|"+/', '_', $size));
        $size = preg_replace('/\s+(?=[^()]*(\(|$))/', '-', $size);
        $size = preg_replace('/\//', '_', $size);

        echo '            <img src="' . PageConstants::IMAGE_FOLDER . $category . '/' . $subcategory . '/' .
            $groupCode . $color . $size . '.jpg">' . "\n";
    }

    public function showFooterContent(): void {
        echo '<footer class="' . PageConstants::CLEAR_FLOAT_CLASS . '">' . "\n";
        echo '    <div class="' . PageConstants::DARK_BACKGROUND_CLASS . '">' . "\n";
        echo '        <section class="' . PageConstants::HOURS_CLASS . ' ' . PageConstants::FOUR_COLUMNS_CLASS . '">' . "\n\n";
        echo '            <ul>' . "\n";
        echo '                <li>Monday - Thursday</li>' . "\n";
        echo '                <li>9am to 6pm</li>' . "\n";
        echo '                <li>Friday - Saturday</li>' . "\n";
        echo '                <li>9am to 9pm</li>' . "\n";
        echo '                <li>Closed Sunday</li>' . "\n";
        echo '            </ul>' . "\n\n";
        echo '        </section>' . "\n\n";
        echo '        <section class="' . PageConstants::ADDRESS_CLASS . ' ' . PageConstants::FOUR_COLUMNS_CLASS . '">' . "\n\n";
        echo '            <ul>' . "\n";
        echo '                <li>Portland Art Supply</li>' . "\n";
        echo '                <li>352 N Lombard St</li>' . "\n";
        echo '                <li>Portland, OR 97205</li>' . "\n";
        echo '                <!-- The number below displays in mobile view only. It provides the ability for users ' .
            'to tap on the number to open their phones dialing application -->' . "\n";
        echo '                <li><a class="' . PageConstants::PHONE_MOBILE_CLASS . '" href="tel:503-555-5555">(503) 555-5555</a></li>' . "\n";
        echo '                <!-- The number below displays in tablet and desktop view only. -->' . "\n";
        echo '                <li><a class="' . PageConstants::PHONE_NOT_MOBILE_CLASS . '">(503) 555-5555</a></li>' . "\n";
        echo '            </ul>' . "\n\n";
        echo '        </section>' . "\n\n";
        echo '        <section class="' . PageConstants::SOCIAL_CLASS . ' ' . PageConstants::FOUR_COLUMNS_CLASS . '">' . "\n\n";
        echo '            <ul>' . "\n";
        echo '                <li><a id="' . PageConstants::FACEBOOK_ID . '" class="' . PageConstants::ICON_CLASS . '" href="' . PageConstants::FACEBOOK_PAGE_URL . '" target="_blank"><img src="' . PageConstants::IMAGE_FOLDER .
            PageConstants::SOCIAL_FOLDER . PageConstants::FACEBOOK_ICON . '" alt="' . PageConstants::FACEBOOK_ICON_ALT . '"></a></li>' . "\n";
        echo '                <li><a id="' . PageConstants::X_ID . '" class="' . PageConstants::ICON_CLASS . '" href="' . PageConstants::TWITTER_PAGE_URL . '" target="_blank"><img src="' . PageConstants::IMAGE_FOLDER .
            PageConstants::SOCIAL_FOLDER . PageConstants::X_ICON . '" alt="' . PageConstants::X_ICON_ALT . '"></a></li>' . "\n";
        echo '                <li><a id="' . PageConstants::INSTAGRAM_ID . '" class="' . PageConstants::ICON_CLASS . '" href="' . PageConstants::INSTAGRAM_PAGE_URL . '" target="_blank"><img src="' .
            PageConstants::IMAGE_FOLDER . PageConstants::SOCIAL_FOLDER . PageConstants::INSTAGRAM_ICON . '" alt="' . PageConstants::INSTAGRAM_ICON_ALT . '"></a></li>' . "\n";
        echo '                <li><a id="' . PageConstants::PINTEREST_ID . '" class="' . PageConstants::ICON_CLASS . '" href="' . PageConstants::PINTEREST_PAGE_URL . '" target="_blank"><img src="' . PageConstants::IMAGE_FOLDER .
            PageConstants::SOCIAL_FOLDER . PageConstants::PINTEREST_ICON . '" alt="' . PageConstants::PINTEREST_ICON_ALT . '"></a></li>' . "\n";
        echo '            </ul>' . "\n\n";
        echo '        </section>' . "\n\n";
        echo '        <br class="' . PageConstants::CLEAR_FLOAT_CLASS . '"> <!-- This clears the column floats from grid.css, otherwise the ' .
            'background image here won\'t display. -->' . "\n";
        echo '    </div>' . "\n";
        echo '</footer>' . "\n";
    }
}