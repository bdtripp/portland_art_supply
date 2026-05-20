<?php

/*
 * users Table
 */
const USERS_TABLE = 'users';

const USER_ID_FIELD = 'user_id';
const USERS_USERNAME_FIELD = 'username';
const USERS_HASH_FIELD = 'password_hash';

/*
 * account_data Table
 */
const ACCOUNT_DATA_TABLE = 'account_data';

const ACCOUNT_DATA_USER_ID_FIELD = 'user_id';
const ACCOUNT_DATA_SESSION_DATA_FIELD = 'session_data';

/*
 * product_manufacturer Table
 */

const PRODUCT_MANUFACTURER_TABLE = 'product_manufacturer';

const PRODUCT_MANUFACTURER_ID_FIELD = 'manufacturer_id';
const PRODUCT_MANUFACTURER_NAME_FIELD = 'manufacturer_name';

/*
 * product_category Table
 */

const PRODUCT_CATEGORY_TABLE = 'product_category';

const PRODUCT_CATEGORY_ID_FIELD = 'category_id';
const PRODUCT_CATEGORY_NAME_FIELD = 'category_name';

/*
 * product_subcategory Table
 */

const PRODUCT_SUBCATEGORY_TABLE = 'product_subcategory';

const PRODUCT_SUBCATEGORY_ID_FIELD = 'subcategory_id';
const PRODUCT_SUBCATEGORY_CATEGORY_ID_FIELD = 'category_id';
const PRODUCT_SUBCATEGORY_NAME_FIELD = 'subcategory_name';

/*
 * product_color Table
 */

const PRODUCT_COLOR_TABLE = 'product_color';

const PRODUCT_COLOR_ID_FIELD = 'color_id';
const PRODUCT_COLOR_NAME_FIELD = 'color_name';

/*
 * product_size Table
 */

const PRODUCT_SIZE_TABLE = 'product_size';

const PRODUCT_SIZE_ID_FIELD = 'size_id';
const PRODUCT_SIZE_DESCRIPTION_FIELD = 'size_description';

/*
 * product_group Table
 */

const PRODUCT_GROUP_TABLE = 'product_group';

const PRODUCT_GROUP_ID_FIELD = 'product_group_id';
const PRODUCT_GROUP_CATEGORY_ID_FIELD = 'category_id';
const PRODUCT_GROUP_SUBCATEGORY_ID_FIELD = 'subcategory_id';
const PRODUCT_GROUP_MANUFACTURER_ID_FIELD = 'manufacturer_id';
const PRODUCT_GROUP_DESCRIPTION_FIELD = 'group_description';
const PRODUCT_GROUP_INFORMATION_FIELD = 'group_information';
const PRODUCT_GROUP_CODE_FIELD = "group_code";

/*
 * product_item Table
 */
const PRODUCT_ITEM_TABLE = 'product_item';

const PRODUCT_ITEM_ID_FIELD = 'product_item_id';
const PRODUCT_ITEM_GROUP_ID_FIELD = 'product_group_id';
const PRODUCT_ITEM_COLOR_ID_FIELD = 'color_id';
const PRODUCT_ITEM_SIZE_ID_FIELD = 'size_id';
const PRODUCT_ITEM_PRICE_FIELD = 'price';

/*
 * Misc
 */

const QUANTITY_FIELD = 'Quantity';
const SUBTOTAL_FIELD = 'Subtotal';
const TOTAL_FIELD = "Total";