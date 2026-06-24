<?php

/**
 * Centralized database schema constants.
 *
 * This class defines the table names and column identifiers used throughout
 * the application.
 */

declare(strict_types=1);

namespace PAS\Config;

class DbConstants
{
    /*
    * users Table
    */
    public const USERS_TABLE = 'users';

    public const USER_ID_FIELD = 'user_id';
    public const USERS_USERNAME_FIELD = 'username';
    public const USERS_HASH_FIELD = 'password_hash';

    /*
    * account_data Table
    */
    public const ACCOUNT_DATA_TABLE = 'account_data';

    public const ACCOUNT_DATA_USER_ID_FIELD = 'user_id';
    public const ACCOUNT_DATA_SESSION_DATA_FIELD = 'session_data';

    /*
    * product_manufacturer Table
    */

    public const PRODUCT_MANUFACTURER_TABLE = 'product_manufacturer';

    public const PRODUCT_MANUFACTURER_ID_FIELD = 'manufacturer_id';
    public const PRODUCT_MANUFACTURER_NAME_FIELD = 'manufacturer_name';

    /*
    * product_category Table
    */

    public const PRODUCT_CATEGORY_TABLE = 'product_category';

    public const PRODUCT_CATEGORY_ID_FIELD = 'category_id';
    public const PRODUCT_CATEGORY_NAME_FIELD = 'category_name';

    /*
    * product_subcategory Table
    */

    public const PRODUCT_SUBCATEGORY_TABLE = 'product_subcategory';

    public const PRODUCT_SUBCATEGORY_ID_FIELD = 'subcategory_id';
    public const PRODUCT_SUBCATEGORY_CATEGORY_ID_FIELD = 'category_id';
    public const PRODUCT_SUBCATEGORY_NAME_FIELD = 'subcategory_name';

    /*
    * product_color Table
    */

    public const PRODUCT_COLOR_TABLE = 'product_color';

    public const PRODUCT_COLOR_ID_FIELD = 'color_id';
    public const PRODUCT_COLOR_NAME_FIELD = 'color_name';

    /*
    * product_size Table
    */

    public const PRODUCT_SIZE_TABLE = 'product_size';

    public const PRODUCT_SIZE_ID_FIELD = 'size_id';
    public const PRODUCT_SIZE_DESCRIPTION_FIELD = 'size_description';

    /*
    * product_group Table
    */

    public const PRODUCT_GROUP_TABLE = 'product_group';

    public const PRODUCT_GROUP_ID_FIELD = 'product_group_id';
    public const PRODUCT_GROUP_CATEGORY_ID_FIELD = 'category_id';
    public const PRODUCT_GROUP_SUBCATEGORY_ID_FIELD = 'subcategory_id';
    public const PRODUCT_GROUP_MANUFACTURER_ID_FIELD = 'manufacturer_id';
    public const PRODUCT_GROUP_DESCRIPTION_FIELD = 'group_description';
    public const PRODUCT_GROUP_INFORMATION_FIELD = 'group_information';
    public const PRODUCT_GROUP_CODE_FIELD = 'group_code';

    /*
    * product_item Table
    */
    public const PRODUCT_ITEM_TABLE = 'product_item';

    public const PRODUCT_ITEM_ID_FIELD = 'product_item_id';
    public const PRODUCT_ITEM_GROUP_ID_FIELD = 'product_group_id';
    public const PRODUCT_ITEM_COLOR_ID_FIELD = 'color_id';
    public const PRODUCT_ITEM_SIZE_ID_FIELD = 'size_id';
    public const PRODUCT_ITEM_PRICE_FIELD = 'price';
}
