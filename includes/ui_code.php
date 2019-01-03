<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 11/11/2018
 * Time: 3:14 PM
 */

// TODO: add urlencode to variable values being passed via url, such as in the $hrefString?

const ROWS_PER_COLUMN = 3;
const QUANTITY_MIN = 1;
const QUANTITY_MAX = 50;
const SIZE_OF_PRODUCT_GROUPS_ROW = 3;

function show_header_content($categoryName) {
    if (isset($_SESSION[SESSION_USER_ID_KEY])) {
        $loginHref = LOGOUT_PAGE;
        $username = get_session_value(SESSION_USERNAME_KEY);
        $iconID = LOGOUT_ICON_ID;
        $iconSrc = 'logout_icon.png';
    } else {
        $loginHref = LOGIN_PAGE;
        $username = '';
        $iconID = LOGIN_ICON_ID;
        $iconSrc = 'login_icon.png';
    }

    echo '<header>' . "\n\n";
    echo '    <!-- collapsable menu -->';
    echo '    <input class="' . MENU_BUTTON_CLASS . '" type="checkbox"' . ' ' . 'id="' . MENU_BUTTON_CLASS . '" />'  . "\n";
    echo '    <label class="' . MENU_ICON_CLASS . '" for="' . MENU_BUTTON_CLASS . '"><span class="' .
                NAVIGATION_ICON_CLASS . '"></span></label>' . "\n\n";
    echo '    <h1 id="' . WRAP_PAS . '">Portland<br>Art Supply</h1>' . "\n\n";
    echo '    <h1 id="' . NO_WRAP_PAS . '">Portland Art Supply</h1>' . "\n\n";
    echo '    <ul class="' . HEADER_LINKS_CLASS . '">' . "\n";
    echo '        <li>' . "\n";
    echo '            <a class="' . SHOPPING_CART_ICON_CLASS . '" href="' . SHOPPING_CART_PAGE . '">' . "\n";
    echo '                <img src="' . IMAGE_FOLDER . SHOPPING_CART_IMAGE . '" alt="' . SHOPPING_CART_IMAGE_ALT . '">' . "\n";
    echo '                <p id="' . CART_COUNT_DISPLAY_ID . '">' . getNumItemsInCart() . '</p>' . "\n";
    echo '            </a>' . "\n";
    echo '        </li>' . "\n";
    echo '        <li>' . "\n";
    echo '            <a id="' . USERNAME_DISPLAY_ID . '">'. $username . '</a>' . "\n";
    echo '        </li>' . "\n";
    echo '        <li>' . "\n";
    echo '            <a id="' . LOGIN_LINK_ID . '" href="' . $loginHref . '">' . "\n";
    echo '                <img id="' . $iconID . '" src="' . IMAGE_FOLDER . $iconSrc . '">' . "\n";
    echo '            </a>' . "\n";
    echo '        </li>' . "\n";
    echo '    </ul>' . "\n\n";
    echo '    <nav>' . "\n\n";
    echo '        <ul class="' . MENU_CLASS . '">' . "\n";
    generateNavList($categoryName);
    echo '        </ul>' . "\n\n";
    echo '    </nav>' . "\n\n";

    echo '</header>' . "\n\n";
}

function generateNavList($activePage) {
    $categories = lookup_categories();

    if ($activePage == HOME_PAGE_TITLE) {
        echo '            <li class="active"><a href="#">Home</a></li>' . "\n";
    } else {
        echo '            <li><a href="' . HOME_PAGE . '">Home</a></li>' . "\n";
    }
    foreach($categories as $category) {
        $href = SUBCATEGORIES_PAGE . '?' . PRODUCT_CATEGORY_ID_FIELD . '=' .
            $category[PRODUCT_CATEGORY_ID_FIELD] . '&' . PRODUCT_CATEGORY_NAME_FIELD . '=' .
            $category[PRODUCT_CATEGORY_NAME_FIELD];

        if ($category[PRODUCT_CATEGORY_NAME_FIELD] == $activePage) {
            echo '            <li class="active"><a href="' . $href . '">' . $activePage . '</a></li>' . "\n";
        } else {
            echo '            <li><a href="' . $href . '">' . $category[PRODUCT_CATEGORY_NAME_FIELD] .  '</a></li>' . "\n";
        }
    }
    if ($activePage == ABOUT_PAGE_TITLE) {
        echo '            <li class="active"><a href="#">About</a></li>' . "\n";
    } else {
        echo '            <li><a href="' . ABOUT_PAGE . '">About</a></li>' . "\n";
    }

}

function show_subcategory_content($categoryID, $categoryName) {
    echo '<main>' . "\n";
    echo '    <h2 class="' . LARGE_H2 . '">' . $categoryName . '</h2>' . "\n\n";
    echo '    <section class="' . SUB_INTRO_CLASS . '">' . "\n";
    echo '        <p>To view our products, select the type of ' . strtolower($categoryName) . ' you are looking for.</p>' . "\n";
    echo '    </section>' . "\n\n";
    echo '    <section class="' . SUBCATEGORIES_CLASS . ' ' . SIX_COLUMNS_CLASS . '">' . "\n\n";
    show_subcategories($categoryID, $categoryName, ROWS_PER_COLUMN);
    show_subcategories($categoryID, $categoryName, ROWS_PER_COLUMN + ROWS_PER_COLUMN);
    echo '    </section>' . "\n\n";
    echo '    <section class="' . LARGE_IMAGE_CLASS . ' ' . SIX_COLUMNS_CLASS . '"></section>' . "\n";
    echo '</main>' . "\n\n";
}

function show_subcategories($categoryID, $categoryName, $rowsPerColumn) {
    $subcategories = lookup_subcategories($categoryID);

    echo '        <div class="' . SIX_COLUMNS_CLASS . '">' . "\n";
    echo '            <ul>' . "\n";
    for ($i = $rowsPerColumn - ROWS_PER_COLUMN; ($i < $rowsPerColumn) && ($i < sizeof($subcategories)); $i++) {
        echo '                <li class="' . SUBCATEGORY_BUTTON_CLASS . '">' . "\n";
        echo '                    <a href="' . GROUP_PRODUCTS_PAGE . "?" . PRODUCT_CATEGORY_NAME_FIELD . "=" . urlencode($categoryName) . "&" .
                                      PRODUCT_SUBCATEGORY_NAME_FIELD . "=" . urlencode($subcategories[$i][PRODUCT_SUBCATEGORY_NAME_FIELD]) . '">'
                                      . ucfirst($subcategories[$i][PRODUCT_SUBCATEGORY_NAME_FIELD]) . '</a>' . "\n";
        echo '                </li>' . "\n";
    }
    echo '            </ul>' . "\n";
    echo '        </div>' . "\n\n";
}

function show_group_content($products) {
    echo '<main>' . "\n";
    echo '    <h2 class="' . LARGE_H2 . '">' . $products[0][PRODUCT_SUBCATEGORY_NAME_FIELD] . '</h2>' . "\n\n";
    echo '    <section id="' . PRODUCT_GROUPS_ID . '">' . "\n";
    echo '        <div class="' . GROUP_ROW_CLASS . '">' . "\n\n";
    for ($i = 0; $i < sizeof($products); $i++) {
        // Creates a div with three product groups per row
        if ($i % SIZE_OF_PRODUCT_GROUPS_ROW == 0 && $i != 0) {
            echo '        </div>' . "\n";
            echo '        <div class="' . GROUP_ROW_CLASS . '">' . "\n\n";
        }
        show_product_groups($products[$i]);
    }
    echo '        </div>' . "\n";
    echo '    </section>' . "\n";
    echo '</main>' . "\n\n";
}

function show_product_groups($product) {
    $hrefString = 'href="' . PRODUCT_ITEMS_PAGE . '?' . PRODUCT_GROUP_ID_FIELD . '=' . urlencode($product[PRODUCT_GROUP_ID_FIELD]);
    $hrefString .= '&' . PRODUCT_CATEGORY_NAME_FIELD . '=' . urlencode($product[PRODUCT_CATEGORY_NAME_FIELD]);
    $hrefString .= '&' . PRODUCT_SUBCATEGORY_NAME_FIELD . '=' . urlencode($product[PRODUCT_SUBCATEGORY_NAME_FIELD]);
    $hrefString .= '&' . PRODUCT_GROUP_CODE_FIELD . '=' . urlencode($product[PRODUCT_GROUP_CODE_FIELD]) . '"';
    echo '            <div class="' . PRODUCT_GROUP_CLASS . ' ' . FOUR_COLUMNS_CLASS . '">' . "\n";
    echo '                <a class="' . GROUP_DESCRIPTION_TEXT_CLASS . '" ' . "\n";
    echo '                     ' . $hrefString . '>' . "\n";
    echo '                     ' . $product[PRODUCT_GROUP_DESCRIPTION_FIELD] . '</a>' . "\n";
    echo '                <a ' . $hrefString . '>' . "\n";
    echo '                    <img src="' . IMAGE_FOLDER . $product[PRODUCT_CATEGORY_NAME_FIELD] . '/' .
                                    $product[PRODUCT_SUBCATEGORY_NAME_FIELD]
                                    . '/' . $product[PRODUCT_GROUP_CODE_FIELD] . '.jpg">' . "\n";
    echo '                </a>' . "\n";
    echo '            </div>' . "\n\n";
}

function show_item_content($productGroup, $categoryName, $subCategoryName) {
    echo '<main>' . "\n";
    echo '    <h2 id="' . MOBILE_H2 . '">' . $productGroup[PRODUCT_GROUP_DESCRIPTION_FIELD] . '</h2>' . "\n";
    echo '    <section id="' . ITEM_WRAPPER_ID . '">' . "\n";
    echo '        <div id="' . IMAGE_WRAPPER_ID . '" class="' . FIVE_COLUMNS_CLASS . '">' . "\n";
    echo '            <img id=' . PRODUCT_ITEM_IMAGE_ID . ' src="' . IMAGE_FOLDER . $categoryName . '/' .
        $subCategoryName . '/' . $productGroup[PRODUCT_GROUP_CODE_FIELD] . '.jpg">' . "\n";
    echo '        </div>' . "\n";
    echo '        <div id="' . DETAILS_WRAPPER_ID . '" class="' . SEVEN_COLUMNS_CLASS . '">' . "\n";
    echo '            <div id="' . ITEM_DETAILS_DIV . '">' . "\n";
    echo '                <h2 id="' . NON_MOBILE_H2 . '">' . $productGroup[PRODUCT_GROUP_DESCRIPTION_FIELD] . '</h2>' . "\n";
    echo '                <p id="' . GROUP_INFORMATION_ID . '">' . $productGroup[PRODUCT_GROUP_INFORMATION_FIELD] . '</p>' . "\n";
    echo '                <div id="' . ITEM_OPTIONS_DIV . '">' . "\n";
    echo '                    <div id="' . ITEM_OPTIONS_RIGHT_COL_WRAPPER_ID . '" class="' . SIX_COLUMNS_CLASS . '">' . "\n";
    echo '                        <div id="' . ITEM_OPTIONS_RIGHT_COL . '">' . "\n";
    echo '                        </div>' . "\n";
    echo '                    </div>' . "\n";
    echo '                </div>' . "\n";
    echo '            </div>' . "\n";
    echo '        </div>' ."\n";
    echo '    </section>' ."\n";
    echo '</main>' . "\n\n";
}

function show_shopping_cart_content() {
    $itemsInCart = get_session_value(SESSION_CART_KEY);

    echo '<main>' . "\n";
    echo '    <section id="cart_items">' . "\n";
    echo '        <h2>' . 'Shopping Cart' . '</h2>' . "\n";
    if (!empty($itemsInCart)) {
        show_items_in_cart($itemsInCart);
        echo '        <p id="' . TOTAL_DISPLAY_ID . '">Total: <span class="' . PRICE_DISPLAY_CLASS . '">$' . number_format(getCartTotal(), 2) . '</span></p>' . "\n";
        echo '        <input id="' . CHECKOUT_BUTTON_ID . '" type="button" value="Checkout">' . "\n";
    } else {
        echo '        <p id="' . EMPTY_CART_MESSAGE . '">There are no items currently in the cart</p>' . "\n";
    }
    echo '    </section>' . "\n";
    echo '</main>' . "\n\n";
}

function show_items_in_cart($itemsInCart) {
    foreach ($itemsInCart as $item) {
        $id = $item[PRODUCT_ITEM_ID_FIELD];
        $groupDescription = $item[PRODUCT_GROUP_DESCRIPTION_FIELD];
        $categoryName = $item[PRODUCT_CATEGORY_NAME_FIELD];
        $subcategoryName = $item[PRODUCT_SUBCATEGORY_NAME_FIELD];
        $groupCode = $item[PRODUCT_GROUP_CODE_FIELD];
        $color = $item[PRODUCT_COLOR_NAME_FIELD];
        $size = $item[PRODUCT_SIZE_DESCRIPTION_FIELD];
        $price = $item[PRODUCT_ITEM_PRICE_FIELD];
        $quantity = $item[QUANTITY_FIELD];

        echo '        <div id="product_id_' . $id . '_div" class="' . CART_ITEM_CLASS . '">' . "\n";
        displayItemImage($categoryName, $subcategoryName,
            $groupCode, $color,
            $size);
        echo '            <div class="' . CART_ITEM_INFO_CLASS . ' ' . NINE_COLUMNS_CLASS . '">' . "\n";
        echo '                <div class="' . CART_ITEM_SPECS_CLASS . ' ' . FOUR_COLUMNS_CLASS . '">' . "\n";
        echo '                    <p>' . $groupDescription . '</p>' . "\n";
        if ($color != 'null') {
            echo '                    <p> Color: ' . $color . '</p>' . "\n";
        }
        if ($size != 'null') {
            echo '                    <p> Size: ' . $size . '</p>' . "\n";
        }
        echo '                </div>' . "\n";
        echo '                <p class="' . PRICE_DISPLAY_CLASS . ' ' . TWO_COLUMNS_CLASS . '">$' . $price . '</p>' . "\n";
        echo '                <div class="' . QUANTITY_AND_SUBTOTAL_CLASS . ' ' . SIX_COLUMNS_CLASS . '">' . "\n";
        echo '                    <div class="' . QUANTITY_DIV_CLASS . ' ' . SIX_COLUMNS_CLASS . '">'. "\n";
        echo '                        <p>Quantity: </p>' . "\n";
        echo '                        <select id="quantity_product_id_' . $id .
                                        '" onchange="onCartPageQuantityChanged(this.id, ' . $id . ')">' . "\n";
        for ($count = QUANTITY_MIN; $count <= QUANTITY_MAX; $count++) {
            if ($count == $quantity) {
                echo '                            <option value="' . $count . '" selected="' . $quantity . '">' . $count . '</option>' . "\n";
            } else {
                echo '                            <option value="' . $count . '">' . $count . '</option>' , "\n";
            }
        }
        echo '                        </select>' . "\n";
        echo '                    </div>' . "\n";
        echo '                    <p id="' . "subtotal_product_" . $id . '" class="' . SUBTOTAL_CLASS . ' ' . SIX_COLUMNS_CLASS . '">Subtotal:' .
                                    '<span class="' . PRICE_DISPLAY_CLASS . '">$' . number_format($price * $quantity, 2) . '</span></p>' . "\n";
        echo '                </div>' . "\n";
        echo '            </div>' ."\n";
        echo '            <input id="' . $item[PRODUCT_ITEM_ID_FIELD] . '" class="' . REMOVE_BUTTON_CLASS . '" type="button" value="Remove"' .
                                ' onclick="onRemoveClicked(this.id,\'shopping_cart.php\')">' . "\n";
        echo '        </div>' . "\n";
    }
}

function displayItemImage($category, $subcategory, $groupCode, $color, $size) {
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

    echo '            <img class="'. THREE_COLUMNS_CLASS . '" src="' . IMAGE_FOLDER . $category . '/' . $subcategory . '/' .
                            $groupCode . $color . $size . '.jpg">' . "\n";
}

function show_footer_content() {
    echo '<footer class="' . CLEAR_FLOAT_CLASS . '">' . "\n";
    echo '    <div class="' . DARK_BACKGROUND_CLASS . '">' . "\n";
    echo '        <section class="' . HOURS_CLASS . ' ' . FOUR_COLUMNS_CLASS . '">' . "\n\n";
    echo '            <ul>' . "\n";
    echo '                <li>Monday - Thursday</li>' . "\n";
    echo '                <li>9am to 6pm</li>' . "\n";
    echo '                <li>Friday - Saturday</li>' . "\n";
    echo '                <li>9am to 9pm</li>' . "\n";
    echo '                <li>Closed Sunday</li>' . "\n";
    echo '            </ul>' . "\n\n";
    echo '        </section>' . "\n\n";
    echo '        <section class="' . ADDRESS_CLASS . ' ' . FOUR_COLUMNS_CLASS . '">' . "\n\n";
    echo '            <ul>' . "\n";
    echo '                <li>Portland Art Supply</li>' . "\n";
    echo '                <li>352 N Lombard St</li>' . "\n";
    echo '                <li>Portland, OR 97205</li>' . "\n";
    echo '                <!-- The number below displays in mobile view only. It provides the ability for users ' .
                           'to tap on the number to open their phones dialing application -->' . "\n";
    echo '                <li><a class="' . PHONE_MOBILE_CLASS . '" href="tel:503-555-5555">(503) 555-5555</a></li>' . "\n";
    echo '                <!-- The number below displays in tablet and desktop view only. -->' . "\n";
    echo '                <li><a class="' . PHONE_NOT_MOBILE_CLASS . '">(503) 555-5555</a></li>' . "\n";
    echo '            </ul>' . "\n\n";
    echo '        </section>' . "\n\n";
    echo '        <section class="' . SOCIAL_CLASS . ' ' . FOUR_COLUMNS_CLASS . '">' . "\n\n";
    echo '            <ul>' . "\n";
    echo '                <li><a class="' . ICON_CLASS . '" href="' . FACEBOOK_PAGE_URL . '"><img src="' . IMAGE_FOLDER .
        SOCIAL_FOLDER . FACEBOOK_ICON . '" alt="' . FACEBOOK_ICON_ALT . '"></a></li>' . "\n";
    echo '                <li><a class="' . ICON_CLASS . '" href="' . TWITTER_PAGE_URL . '"><img src="' . IMAGE_FOLDER .
        SOCIAL_FOLDER . TWITTER_ICON . '" alt="' . TWITTER_ICON_ALT . '"></a></li>' . "\n";
    echo '                <li><a class="' . ICON_CLASS . '" href="' . INSTAGRAM_PAGE_URL . '"><img src="' .
        IMAGE_FOLDER . SOCIAL_FOLDER . INSTAGRAM_ICON . '" alt="' . INSTAGRAM_ICON_ALT . '"></a></li>' . "\n";
    echo '                <li><a class="' . ICON_CLASS . '" href="' . PINTEREST_PAGE_URL . '"><img src="' . IMAGE_FOLDER .
        SOCIAL_FOLDER . PINTEREST_ICON . '" alt="' . PINTEREST_ICON_ALT . '"></a></li>' . "\n";
    echo '            </ul>' . "\n\n";
    echo '        </section>' . "\n\n";
    echo '        <br class="' . CLEAR_FLOAT_CLASS . '"> <!-- This clears the column floats from grid.css, otherwise the ' .
                    'background image here won\'t display. -->' . "\n";
    echo '    </div>' . "\n";
    echo '</footer>' . "\n";
}

?>