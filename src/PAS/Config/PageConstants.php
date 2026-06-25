<?php

declare(strict_types=1);

namespace PAS\Config;

/**
 * UI‑related constants used throughout the PAS frontend.
 *
 * Includes page routes, titles, element IDs, CSS classes, image names,
 * and social media URLs.
 */
class PageConstants
{
    /*
    * Page Routes
    */

    public const DOMAIN_NAME = 'http://localhost';
    public const HOME_PAGE = '/';
    public const ABOUT_PAGE = '/about.php';
    public const LOGIN_PAGE = '/login.php';
    public const LOGOUT_PAGE = '/logout.php';
    public const CREATE_ACCOUNT_PAGE = '/create_account.php';
    public const SHOPPING_CART_PAGE = '/shopping_cart.php';
    public const SUBCATEGORIES_PAGE = '/subcategories.php';
    public const GROUP_PRODUCTS_PAGE = '/product_groups.php';
    public const PRODUCT_ITEMS_PAGE = '/product_items.php';

    /*
    * Page Titles
    */

    public const HOME_PAGE_TITLE = 'Home';
    public const SHOPPING_CART_PAGE_TITLE = 'Cart';
    public const ABOUT_PAGE_TITLE = 'About';

    /*
    * Folders
    */

    public const IMAGE_FOLDER = 'images/';
    public const SOCIAL_FOLDER = 'Social/';

    /*
    * Images and alt text
    */

    public const SHOPPING_CART_IMAGE = 'shopping_cart.png';
    public const SHOPPING_CART_IMAGE_ALT = 'Shopping Cart Icon';
    public const FACEBOOK_ICON = 'facebook.png';
    public const FACEBOOK_ICON_ALT = 'Facebook Icon';
    public const X_ICON = 'x.png';
    public const X_ICON_ALT = 'X Icon';
    public const INSTAGRAM_ICON = 'instagram.png';
    public const INSTAGRAM_ICON_ALT = 'Instagram Icon';
    public const PINTEREST_ICON = 'pinterest.png';
    public const PINTEREST_ICON_ALT = 'Pinterest Icon';

    /*
    * IDs
    */

    public const PRODUCT_ITEM_IMAGE_ID = 'product_item_image';
    public const LOGIN_LINK_ID = 'login_link';
    public const CART_COUNT_DISPLAY_ID = 'cart_count_display';
    public const TOTAL_DISPLAY_ID = 'total_display';
    public const ITEM_DETAILS_DIV = 'item_details';
    public const ITEM_OPTIONS_DIV = 'item_options';
    public const ITEM_OPTIONS_RIGHT_COL = 'item_options_right_col';
    public const GROUP_INFORMATION_ID = 'group_info';
    public const PRODUCT_GROUPS_ID = 'product_groups';
    public const CHECKOUT_BUTTON_ID = 'checkout_button';
    public const LOGIN_ICON_ID = 'login_icon';
    public const LOGOUT_ICON_ID = 'logout_icon';
    public const USERNAME_DISPLAY_ID = 'username_display';
    public const WRAP_PAS = 'wrap_pas';
    public const NO_WRAP_PAS = 'no_wrap_pas';
    public const ITEM_WRAPPER_ID = 'item_wrapper';
    public const IMAGE_WRAPPER_ID = 'image_wrapper';
    public const DETAILS_WRAPPER_ID = 'details_wrapper';
    public const MOBILE_H2 = 'mobile_version';
    public const NON_MOBILE_H2 = 'non_mobile_version';
    public const COLOR_DIV_ID = 'color';
    public const SIZE_DIV_ID = 'size';
    public const QUANTITY_DIV_ID = 'quantity';
    public const PASSWORD_MESSAGE_ID = 'password_message';
    public const USERNAME_MESSAGE_ID = 'username_message';
    public const CONFIRM_PASSWORD_MESSAGE_ID = 'confirm_password_message';
    public const USERNAME_INPUT_ID = 'username_input';
    public const PASSWORD_INPUT_ID = 'password_input';
    public const CONFIRM_PASSWORD_INPUT_ID = 'confirm_password_input';
    public const LINKS_CLASS = 'links';
    public const ERROR_MESSAGE_CONTAINER = 'error_message_container';
    public const COLOR_THUMBNAILS_WRAPPER_ID = 'color_thumbnails_wrapper';
    public const DROP_DOWN_WRAPPER_ID = 'drop_down_wrapper';
    public const ABOUT_TEXT_ID = 'about_text';
    public const ABOUT_IMAGE_DIV_ID = 'about_images';
    public const ABOUT_SECTION_ID = 'about';
    public const COLOR_THUMBNAILS_DIV_ID = 'color_thumbnails';
    public const EMPTY_CART_MESSAGE = 'empty_cart_message';
    public const CARD_CLASS = 'card';
    public const X_ID = 'x';
    public const FACEBOOK_ID = 'facebook';
    public const INSTAGRAM_ID = 'instagram';
    public const PINTEREST_ID = 'pinterest';
    public const CREATE_ACCOUNT_LINK_ID = "create_account_link";
    public const HOME_LINK_ID = "home_link";
    public const UPPERCASE_REQUIREMENT_ID = "uppercase_requirement";
    public const DIGIT_REQUIREMENT_ID = "digit_requirement";
    public const SPECIAL_CHAR_REQUIREMENT_ID = "special_char_requirement";
    public const LENGTH_REQUIREMENT_ID = "length_requirement";
    public const LOGIN_BUTTON_ID = "login_btn";


    /*
    * Classes
    */

    public const SUB_INTRO_CLASS = 'sub_intro';
    public const SUBCATEGORIES_CLASS = 'sub_cats';
    public const MENU_CLASS = 'menu';
    public const MENU_BUTTON_CLASS = 'menu-btn';
    public const MENU_ICON_CLASS = 'menu-icon';
    public const NAVIGATION_ICON_CLASS = 'navicon';
    public const ACTIVE_CLASS = 'active';
    public const CLEAR_FLOAT_CLASS = 'clearfloat';
    public const TWO_COLUMNS_CLASS = 'two columns';
    public const THREE_COLUMNS_CLASS = 'three columns';
    public const FOUR_COLUMNS_CLASS = 'four columns';
    public const FIVE_COLUMNS_CLASS = 'five columns';
    public const SIX_COLUMNS_CLASS = 'six columns';
    public const SEVEN_COLUMNS_CLASS = 'seven columns';
    public const EIGHT_COLUMNS_CLASS = 'eight columns';
    public const NINE_COLUMNS_CLASS = 'nine columns';
    public const TEN_COLUMNS_CLASS = "ten columns";
    public const HOURS_CLASS = 'hours';
    public const ADDRESS_CLASS = 'address';
    public const SOCIAL_CLASS = 'social';
    public const PHONE_MOBILE_CLASS = 'phone_mobile';
    public const PHONE_NOT_MOBILE_CLASS = 'phone_not_mobile';
    public const ICON_CLASS = 'icon';
    public const LARGE_IMAGE_CLASS = 'lg_image';
    public const HEADER_LINKS_CLASS = 'header_links';
    public const DARK_BACKGROUND_CLASS = 'dark_background';
    public const CART_ITEMS_WRAPPER_ID = "cart_items_wrapper";
    public const CART_ITEM_CLASS = 'cart_item';
    public const SUBTOTAL_DISPLAY_CLASS = 'subtotal_display';
    public const GROUP_DESCRIPTION_TEXT_CLASS = "group_description_text";
    public const PRODUCT_GROUP_CLASS = 'product_group';
    public const CART_ITEM_INFO_CLASS = 'cart_item_info';
    public const CART_ITEM_SPECS_CLASS = 'cart_item_specs';
    public const QUANTITY_DIV_CLASS = 'quantity';
    public const PRICE_DISPLAY_CLASS = 'price_display';
    public const QUANTITY_AND_SUBTOTAL_CLASS = 'quantity_and_subtotal';
    public const REMOVE_BUTTON_CLASS = 'remove_button';
    public const SHOPPING_CART_ICON_CLASS = 'shopping_cart_icon';
    public const SUBTOTAL_CLASS = 'subtotal';
    public const LARGE_H2 = 'large_h2';
    public const SUBCATEGORY_BUTTON_CLASS = 'subcategory_button';
    public const NAV_DROPDOWN_CLASS = 'nav_drop_down';
    public const DROPDOWN_CONTENT_CLASS = 'dropdown_content';
    public const MESSAGE_CLASS = 'message';
    public const REQUIREMENTS_CLASS = 'requirements';
    public const MEETS_REQUIREMENTS_CLASS = 'meets_requirements';
    public const STILL_NEEDED_CLASS = 'still_needed';
    public const COLOR_THUMBNAIL_CLASS = 'color_tn';
    public const WRAPPER_CLASS = "wrapper";
    public const PASSWORD_SECTION_CLASS = "password_section";
    public const ERROR_SYMBOL_CLASS = "error_symbol";
    public const MESSAGE_WRAPPER_CLASS = "message_wrapper";

    /*
    * Social Media Sites
    */

    public const FACEBOOK_PAGE_URL = 'https://www.facebook.com/';
    public const TWITTER_PAGE_URL = 'https://x.com/';
    public const INSTAGRAM_PAGE_URL = 'https://www.instagram.com/';
    public const PINTEREST_PAGE_URL = 'https://www.pinterest.com/';
}
