<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 11/11/2018
 * Time: 2:44 PM
 */
session_start();

require_once('includes/page_constants.php');
require_once('includes/db_code.php');
require_once('includes/art_constants.php');
require_once('includes/db_constants.php');
require_once('includes/ui_code.php');
require_once('includes/shopping_cart_code.php');
require_once('includes/login_constants.php');
require_once('includes/utilities.php');

$id = get_post_value(PRODUCT_ITEM_ID_FIELD);
$groupDescription = get_post_value(PRODUCT_GROUP_DESCRIPTION_FIELD);
$category = get_post_value(PRODUCT_CATEGORY_NAME_FIELD);
$subcategory = get_post_value(PRODUCT_SUBCATEGORY_NAME_FIELD);
$groupCode = get_post_value(PRODUCT_GROUP_CODE_FIELD);
$color = get_post_value(PRODUCT_COLOR_NAME_FIELD);
$size = get_post_value(PRODUCT_SIZE_DESCRIPTION_FIELD);
$price = get_post_value(PRODUCT_ITEM_PRICE_FIELD);
$quantity = get_post_value(QUANTITY_FIELD);

if (!empty($id)) {
    addItemToCart(html_entity_decode(urldecode($id)), html_entity_decode(urldecode($category)),
        html_entity_decode(urldecode($subcategory)), html_entity_decode(urldecode($groupCode)),
        html_entity_decode(urldecode($color)), html_entity_decode(urldecode($size)),
        html_entity_decode(urldecode($price)), html_entity_decode(urldecode($quantity)),
        html_entity_decode(urldecode($groupDescription)));
    exit();
}

$categoryName = urldecode($_GET[PRODUCT_CATEGORY_NAME_FIELD]);
$subcategoryName = urldecode($_GET[PRODUCT_SUBCATEGORY_NAME_FIELD]);
$groupCode = urldecode($_GET[PRODUCT_GROUP_CODE_FIELD]);
$groupID = urldecode($_GET[PRODUCT_GROUP_ID_FIELD]);
$productGroup = lookup_group($groupID);
$productItems = lookup_items($groupID);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-135450898-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-135450898-2');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PAS | <?php echo $groupCode; ?></title>

    <link href="includes/reset.css.php" rel="stylesheet">
    <link href="includes/grid.css.php" rel="stylesheet">
    <link href="includes/collapsable_menu.css.php" rel="stylesheet">
    <link href="includes/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <script type="text/javascript">
        var groupCode = '<?php echo $groupCode; ?>';
        var productItems = <?php echo json_encode($productItems); ?>;
        var category = '<?php echo $categoryName; ?>';
        var subcategory = '<?php echo $subcategoryName; ?>';
        var groupDescription = '<?php echo addslashes($productGroup[PRODUCT_GROUP_DESCRIPTION_FIELD]) ?>';
    </script>
    <script src="includes/pas.js.php" type="text/javascript"></script>

</head>

<body onload="init();">

<?php show_header_content($categoryName); ?>
<?php show_item_content($productGroup, $categoryName, $subcategoryName); ?>
<?php show_footer_content(); ?>

</body>

</html>

