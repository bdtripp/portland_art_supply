<?php

namespace PAS\View;

use PAS\Infrastructure\Database;
use PAS\Services\CartService;
use PAS\Config\SessionConstants;
use PAS\Config\PageConstants;
use PAS\Config\DbConstants;
use PAS\Services\SessionService;
use PAS\Support\NavigationHelper;

class LayoutUi
{
    public function __construct(
        private Database $db,
        private CartService $cartService,
        private SessionService $sessionService,
        private NavigationHelper $navigationHelper
    ) {
    }

    public function header(string $categoryName): void
    {
        if (isset($_SESSION[SessionConstants::USER_ID_KEY])) {
            $loginHref = PageConstants::LOGOUT_PAGE;
            $username = e($this->sessionService->get(SessionConstants::USERNAME_KEY));
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
        echo '                <p id="' . PageConstants::CART_COUNT_DISPLAY_ID . '">' . $this->cartService->getNumItemsInCart() . '</p>' . "\n";
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

    public function generateNavList(string $activePage): void
    {
        $categories = $this->db->lookupCategories();

        echo '            <li><a ' . $this->navigationHelper->currentPage(PageConstants::HOME_PAGE) . 'Home</a></li>' . "\n";
        foreach ($categories as $category) {
            $rawCategoryName = $category[DbConstants::PRODUCT_CATEGORY_NAME_FIELD];
            $categoryName = e($rawCategoryName);
            $categoryIdSafe = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '_', $rawCategoryName) ?? '');

            echo '            <li>' . "\n";
            echo '                <button
                                        class="expand_btn"
                                        aria-expanded="false"
                                        aria-haspopup="true"
                                        aria-controls="' . $categoryIdSafe . '_menu"
                                    >' . $categoryName . "\n";
            echo '                    <span class="arrow" aria-hidden="true">▼</span>' . "\n";
            echo '                </button>' . "\n";
            $this->showSubcategoryDropdown($category);
            echo '            </li>' . "\n";
        }
        echo '            <li><a ' . $this->navigationHelper->currentPage(PageConstants::ABOUT_PAGE) . 'About</a></li>' . "\n";
    }

    /**
     * @param array{
     *     category_id: int,
     *     category_name: string
     * } $category
     */
    public function showSubcategoryDropdown(array $category): void
    {
        $categoryID = $category[DbConstants::PRODUCT_CATEGORY_ID_FIELD];
        $rawCategoryName = $category[DbConstants::PRODUCT_CATEGORY_NAME_FIELD];
        $categoryIdSafe = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '_', $rawCategoryName) ?? '');
        $subcategories = $this->db->lookupSubcategories($categoryID);

        echo '                <ul id="' . $categoryIdSafe . '_menu" class="dropdown">' . "\n";
        foreach ($subcategories as $subcategory) {
            $rawSubCategoryName = $subcategory[DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD];
            $subcategoryName = e($rawSubCategoryName);

            echo '                    <li>
                                        <a href="' . PageConstants::GROUP_PRODUCTS_PAGE .
                                            "?" . DbConstants::PRODUCT_CATEGORY_NAME_FIELD . "=" . urlencode($rawCategoryName) .
                                            "&" . DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD . "=" . urlencode($rawSubCategoryName) .
                                            '" ' . $this->navigationHelper->currentSubcategory(DbConstants::PRODUCT_CATEGORY_NAME_FIELD, $rawCategoryName, DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD, $rawSubCategoryName) .
                                        '>' . ucfirst($subcategoryName) .
                                        '</a>
                                    </li>';
        }
        echo '                </ul>' . "\n";
    }

    public function footer(): void
    {
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
