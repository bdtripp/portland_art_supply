<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/22/2018
 * Time: 7:18 PM
 */

const DOMAIN_NAME = 'http://localhost';

const HOME_PAGE = '/portland_art_supply/';
const ABOUT_PAGE = '/portland_art_supply/about.php';
const LOGIN_PAGE = '/portland_art_supply/login.php';
const LOGOUT_PAGE = '/portland_art_supply/logout.php';
const CREATE_ACCOUNT_PAGE = '/portland_art_supply/create_account.php';
const SHOPPING_CART_PAGE = '/portland_art_supply/shopping_cart.php';
const SUBCATEGORIES_PAGE = '/portland_art_supply/subcategories.php';
const GROUP_PRODUCTS_PAGE = '/portland_art_supply/product_groups.php';
const PRODUCT_ITEMS_PAGE = '/portland_art_supply/product_items.php';

/*
 * Category Pages --- remove this onece you delete the paint page
 */

const PAINT_PAGE = '/portland_art_supply/paint.php';

/*
 * Page Titles
 */

const HOME_PAGE_TITLE = 'Home';
const SHOPPING_CART_PAGE_TITLE = 'Cart';
const ABOUT_PAGE_TITLE = 'About';

/*
 * Code Files
 */
const DB_CODE = 'db_code.php';

/*
 * Folders
 */

const IMAGE_FOLDER = 'images/';
const SOCIAL_FOLDER = 'Social/';

/*
 * Images and alt text
 */

const SHOPPING_CART_IMAGE = 'shopping_cart.png';
const SHOPPING_CART_IMAGE_ALT = 'Shopping Cart Icon';
const FACEBOOK_ICON = 'facebook.png';
const FACEBOOK_ICON_ALT = 'Facebook Icon';
const TWITTER_ICON = 'twitter.png';
const TWITTER_ICON_ALT = 'Twitter Icon';
const INSTAGRAM_ICON = 'instagram.png';
const INSTAGRAM_ICON_ALT = 'Instagram Icon';
const PINTEREST_ICON = 'pinterest.png';
const PINTEREST_ICON_ALT = 'Pinterest Icon';

/*
 * IDs
 */

const PRODUCT_ITEM_IMAGE_ID = 'product_item_image';
const LOGIN_LINK_ID = 'login_link';
const CART_COUNT_DISPLAY_ID = 'cart_count_display';
const TOTAL_DISPLAY_ID = 'total_display';
const ITEM_DETAILS_DIV = 'item_details';
const ITEM_OPTIONS_DIV = 'item_options';
const ITEM_OPTIONS_RIGHT_COL = 'item_options_right_col';
const GROUP_INFORMATION_ID = 'group_info';
const PRODUCT_GROUPS_ID ='product_groups';
const CHECKOUT_BUTTON_ID = 'checkout_button';
const LOGIN_ICON_ID = 'login_icon';
const LOGOUT_ICON_ID = 'logout_icon';
const USERNAME_DISPLAY_ID = 'username_display';
const WRAP_PAS = 'wrap_pas';
const NO_WRAP_PAS = 'no_wrap_pas';
const ITEM_WRAPPER_ID = 'item_wrapper';
const IMAGE_WRAPPER_ID = 'image_wrapper';
const DETAILS_WRAPPER_ID = 'details_wrapper';
const MOBILE_H2 = 'mobile_version';
const NON_MOBILE_H2 = 'non_mobile_version';
const COLOR_DIV_ID = 'color';
const SIZE_DIV_ID = 'size';
const QUANTITY_DIV_ID = 'quantity';
const PASSWORD_MESSAGE_ID = 'password_message';
const USERNAME_MESSAGE_ID = 'username_message';
const CONFIRM_PASSWORD_MESSAGE_ID = 'confirm_password_message';
const USERNAME_INPUT_ID = 'username_input';
const PASSWORD_INPUT_ID = 'password_input';
const CONFIRM_PASSWORD_INPUT_ID = 'confirm_password_input';
const LINKS_TD_ID = 'links_td';
const ERROR_MESSAGE_CONTAINER = 'error_message_container';
const COLOR_THUMBNAILS_WRAPPER_ID = 'color_thumbnails_wrapper';
const ITEM_OPTIONS_RIGHT_COL_WRAPPER_ID = 'right_col_wrapper';
const ABOUT_TEXT_ID = 'about_text';
const ABOUT_IMAGE_DIV_ID = 'about_images';
const ABOUT_SECTION_ID = 'about';
const COLOR_THUMBNAILS_DIV_ID = 'color_thumbnails';
const EMPTY_CART_MESSAGE = 'empty_cart_message';
const CARD_CLASS = 'card';

/*
 * Classes
 */

const SUB_INTRO_CLASS = 'sub_intro';
const SUBCATEGORIES_CLASS = 'sub_cats';
const MENU_CLASS = 'menu';
const MENU_BUTTON_CLASS = 'menu-btn';
const MENU_ICON_CLASS = 'menu-icon';
const NAVIGATION_ICON_CLASS = 'navicon';
const ACTIVE_CLASS = 'active';
const CLEAR_FLOAT_CLASS = 'clearfloat';
const TWO_COLUMNS_CLASS = 'two columns';
const THREE_COLUMNS_CLASS = 'three columns';
const FOUR_COLUMNS_CLASS = 'four columns';
const FIVE_COLUMNS_CLASS = 'five columns';
const SIX_COLUMNS_CLASS = 'six columns';
const SEVEN_COLUMNS_CLASS = 'seven columns';
const EIGHT_COLUMNS_CLASS = 'eight columns';
const NINE_COLUMNS_CLASS = 'nine columns';
const TEN_COLUMNS_CLASS = "ten columns";
const HOURS_CLASS = 'hours';
const ADDRESS_CLASS = 'address';
const SOCIAL_CLASS = 'social';
const PHONE_MOBILE_CLASS = 'phone_mobile';
const PHONE_NOT_MOBILE_CLASS = 'phone_not_mobile';
const ICON_CLASS = 'icon';
const LARGE_IMAGE_CLASS = 'lg_image';
const HEADER_LINKS_CLASS = 'header_links';
const DARK_BACKGROUND_CLASS = 'dark_background';
const CART_ITEM_CLASS = 'cart_item';
const SUBTOTAL_DISPLAY_CLASS = 'subtotal_display';
const GROUP_DESCRIPTION_TEXT_CLASS = "group_description_text";
const PRODUCT_GROUP_CLASS = 'product_group';
const GROUP_ROW_CLASS = 'group_row';
const CART_ITEM_INFO_CLASS = 'cart_item_info';
const CART_ITEM_SPECS_CLASS = 'cart_item_specs';
const QUANTITY_DIV_CLASS = 'quantity';
const PRICE_DISPLAY_CLASS = 'price_display';
const QUANTITY_AND_SUBTOTAL_CLASS = 'quantity_and_subtotal';
const REMOVE_BUTTON_CLASS = 'remove_button';
const SHOPPING_CART_ICON_CLASS = 'shopping_cart_icon';
const SUBTOTAL_CLASS = 'subtotal';
const LARGE_H2 = 'large_h2';
const SUBCATEGORY_BUTTON_CLASS = 'subcategory_button';
const NAV_DROPDOWN_CLASS = 'nav_drop_down';
const DROPDOWN_CONTENT_CLASS = 'dropdown_content';
const MESSAGE_TD = 'message_td';
const COLOR_THUMBNAIL_CLASS = 'color_tn';
/*
 * Social Media Sites
 */

const FACEBOOK_PAGE_URL = 'https://www.facebook.com/';
const TWITTER_PAGE_URL = 'https://twitter.com/';
const INSTAGRAM_PAGE_URL = 'https://www.instagram.com/';
const PINTEREST_PAGE_URL = 'https://www.pinterest.com/';

/*
 * Session keys
 */

const SESSION_USER_ID_KEY = 'userID';
const SESSION_USERNAME_KEY = 'username';
const SESSION_CART_KEY = 'cart';
const SESSION_RETURN_TO_URL = 'returnToURL';