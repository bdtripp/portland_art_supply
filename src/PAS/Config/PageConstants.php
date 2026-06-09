<?php

declare(strict_types=1);

namespace PAS\Config;

class PageConstants
{
    public const string DOMAIN_NAME = 'http://localhost';

    public const string HOME_PAGE = '/';
    public const string ABOUT_PAGE = '/about.php';
    public const string LOGIN_PAGE = '/login.php';
    public const string LOGOUT_PAGE = '/logout.php';
    public const string CREATE_ACCOUNT_PAGE = '/create_account.php';
    public const string SHOPPING_CART_PAGE = '/shopping_cart.php';
    public const string SUBCATEGORIES_PAGE = '/subcategories.php';
    public const string GROUP_PRODUCTS_PAGE = '/product_groups.php';
    public const string PRODUCT_ITEMS_PAGE = '/product_items.php';

    /*
    * Page Titles
    */

    public const string HOME_PAGE_TITLE = 'Home';
    public const string SHOPPING_CART_PAGE_TITLE = 'Cart';
    public const string ABOUT_PAGE_TITLE = 'About';

    /*
    * Code Files
    */
    public const string DB_CODE = 'db_code.php';

    /*
    * Folders
    */

    public const string IMAGE_FOLDER = 'images/';
    public const string SOCIAL_FOLDER = 'Social/';

    /*
    * Images and alt text
    */

    public const string SHOPPING_CART_IMAGE = 'shopping_cart.png';
    public const string SHOPPING_CART_IMAGE_ALT = 'Shopping Cart Icon';
    public const string FACEBOOK_ICON = 'facebook.png';
    public const string FACEBOOK_ICON_ALT = 'Facebook Icon';
    public const string X_ICON = 'x.png';
    public const string X_ICON_ALT = 'X Icon';
    public const string INSTAGRAM_ICON = 'instagram.png';
    public const string INSTAGRAM_ICON_ALT = 'Instagram Icon';
    public const string PINTEREST_ICON = 'pinterest.png';
    public const string PINTEREST_ICON_ALT = 'Pinterest Icon';

    /*
    * IDs
    */

    public const string PRODUCT_ITEM_IMAGE_ID = 'product_item_image';
    public const string LOGIN_LINK_ID = 'login_link';
    public const string CART_COUNT_DISPLAY_ID = 'cart_count_display';
    public const string TOTAL_DISPLAY_ID = 'total_display';
    public const string ITEM_DETAILS_DIV = 'item_details';
    public const string ITEM_OPTIONS_DIV = 'item_options';
    public const string ITEM_OPTIONS_RIGHT_COL = 'item_options_right_col';
    public const string GROUP_INFORMATION_ID = 'group_info';
    public const string PRODUCT_GROUPS_ID = 'product_groups';
    public const string CHECKOUT_BUTTON_ID = 'checkout_button';
    public const string LOGIN_ICON_ID = 'login_icon';
    public const string LOGOUT_ICON_ID = 'logout_icon';
    public const string USERNAME_DISPLAY_ID = 'username_display';
    public const string WRAP_PAS = 'wrap_pas';
    public const string NO_WRAP_PAS = 'no_wrap_pas';
    public const string ITEM_WRAPPER_ID = 'item_wrapper';
    public const string IMAGE_WRAPPER_ID = 'image_wrapper';
    public const string DETAILS_WRAPPER_ID = 'details_wrapper';
    public const string MOBILE_H2 = 'mobile_version';
    public const string NON_MOBILE_H2 = 'non_mobile_version';
    public const string COLOR_DIV_ID = 'color';
    public const string SIZE_DIV_ID = 'size';
    public const string QUANTITY_DIV_ID = 'quantity';
    public const string PASSWORD_MESSAGE_ID = 'password_message';
    public const string USERNAME_MESSAGE_ID = 'username_message';
    public const string CONFIRM_PASSWORD_MESSAGE_ID = 'confirm_password_message';
    public const string USERNAME_INPUT_ID = 'username_input';
    public const string PASSWORD_INPUT_ID = 'password_input';
    public const string CONFIRM_PASSWORD_INPUT_ID = 'confirm_password_input';
    public const string LINKS_CLASS = 'links';
    public const string ERROR_MESSAGE_CONTAINER = 'error_message_container';
    public const string COLOR_THUMBNAILS_WRAPPER_ID = 'color_thumbnails_wrapper';
    public const string DROP_DOWN_WRAPPER_ID = 'drop_down_wrapper';
    public const string ABOUT_TEXT_ID = 'about_text';
    public const string ABOUT_IMAGE_DIV_ID = 'about_images';
    public const string ABOUT_SECTION_ID = 'about';
    public const string COLOR_THUMBNAILS_DIV_ID = 'color_thumbnails';
    public const string EMPTY_CART_MESSAGE = 'empty_cart_message';
    public const string CARD_CLASS = 'card';
    public const string X_ID = 'x';
    public const string FACEBOOK_ID = 'facebook';
    public const string INSTAGRAM_ID = 'instagram';
    public const string PINTEREST_ID = 'pinterest';
    public const string CREATE_ACCOUNT_LINK_ID = "create_account_link";
    public const string HOME_LINK_ID = "home_link";
    public const string UPPERCASE_REQUIREMENT_ID = "uppercase_requirement";
    public const string DIGIT_REQUIREMENT_ID = "digit_requirement";
    public const string SPECIAL_CHAR_REQUIREMENT_ID = "special_char_requirement";
    public const string LENGTH_REQUIREMENT_ID = "length_requirement";
    public const string LOGIN_BUTTON_ID = "login_btn";


    /*
    * Classes
    */

    public const string SUB_INTRO_CLASS = 'sub_intro';
    public const string SUBCATEGORIES_CLASS = 'sub_cats';
    public const string MENU_CLASS = 'menu';
    public const string MENU_BUTTON_CLASS = 'menu-btn';
    public const string MENU_ICON_CLASS = 'menu-icon';
    public const string NAVIGATION_ICON_CLASS = 'navicon';
    public const string ACTIVE_CLASS = 'active';
    public const string CLEAR_FLOAT_CLASS = 'clearfloat';
    public const string TWO_COLUMNS_CLASS = 'two columns';
    public const string THREE_COLUMNS_CLASS = 'three columns';
    public const string FOUR_COLUMNS_CLASS = 'four columns';
    public const string FIVE_COLUMNS_CLASS = 'five columns';
    public const string SIX_COLUMNS_CLASS = 'six columns';
    public const string SEVEN_COLUMNS_CLASS = 'seven columns';
    public const string EIGHT_COLUMNS_CLASS = 'eight columns';
    public const string NINE_COLUMNS_CLASS = 'nine columns';
    public const string TEN_COLUMNS_CLASS = "ten columns";
    public const string HOURS_CLASS = 'hours';
    public const string ADDRESS_CLASS = 'address';
    public const string SOCIAL_CLASS = 'social';
    public const string PHONE_MOBILE_CLASS = 'phone_mobile';
    public const string PHONE_NOT_MOBILE_CLASS = 'phone_not_mobile';
    public const string ICON_CLASS = 'icon';
    public const string LARGE_IMAGE_CLASS = 'lg_image';
    public const string HEADER_LINKS_CLASS = 'header_links';
    public const string DARK_BACKGROUND_CLASS = 'dark_background';
    public const string CART_ITEMS_WRAPPER_ID = "cart_items_wrapper";
    public const string CART_ITEM_CLASS = 'cart_item';
    public const string SUBTOTAL_DISPLAY_CLASS = 'subtotal_display';
    public const string GROUP_DESCRIPTION_TEXT_CLASS = "group_description_text";
    public const string PRODUCT_GROUP_CLASS = 'product_group';
    public const string CART_ITEM_INFO_CLASS = 'cart_item_info';
    public const string CART_ITEM_SPECS_CLASS = 'cart_item_specs';
    public const string QUANTITY_DIV_CLASS = 'quantity';
    public const string PRICE_DISPLAY_CLASS = 'price_display';
    public const string QUANTITY_AND_SUBTOTAL_CLASS = 'quantity_and_subtotal';
    public const string REMOVE_BUTTON_CLASS = 'remove_button';
    public const string SHOPPING_CART_ICON_CLASS = 'shopping_cart_icon';
    public const string SUBTOTAL_CLASS = 'subtotal';
    public const string LARGE_H2 = 'large_h2';
    public const string SUBCATEGORY_BUTTON_CLASS = 'subcategory_button';
    public const string NAV_DROPDOWN_CLASS = 'nav_drop_down';
    public const string DROPDOWN_CONTENT_CLASS = 'dropdown_content';
    public const string MESSAGE_CLASS = 'message';
    public const string REQUIREMENTS_CLASS = 'requirements';
    public const string MEETS_REQUIREMENTS_CLASS = 'meets_requirements';
    public const string STILL_NEEDED_CLASS = 'still_needed';
    public const string COLOR_THUMBNAIL_CLASS = 'color_tn';
    public const string WRAPPER_CLASS = "wrapper";
    public const string PASSWORD_SECTION_CLASS = "password_section";
    public const string ERROR_SYMBOL_CLASS = "error_symbol";
    public const string MESSAGE_WRAPPER_CLASS = "message_wrapper";

    /*
    * Social Media Sites
    */

    public const string FACEBOOK_PAGE_URL = 'https://www.facebook.com/';
    public const string TWITTER_PAGE_URL = 'https://x.com/';
    public const string INSTAGRAM_PAGE_URL = 'https://www.instagram.com/';
    public const string PINTEREST_PAGE_URL = 'https://www.pinterest.com/';

    /*
    * Session keys
    */

    public const string SESSION_USER_ID_KEY = 'userID';
    public const string SESSION_USERNAME_KEY = 'username';
    public const string SESSION_CART_KEY = 'cart';
    public const string SESSION_RETURN_TO_URL = 'returnToURL';
}
