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
require_once('includes/login_constants.php');
require_once('includes/utilities.php');
require_once('includes/shopping_cart_code.php');

$categoryName = urldecode($_GET[PRODUCT_CATEGORY_NAME_FIELD]);
$subcategoryName = urldecode($_GET[PRODUCT_SUBCATEGORY_NAME_FIELD]);
$products = lookup_product_groups($categoryName, $subcategoryName);

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PAS | <?php echo $subcategoryName; ?></title>

    <link href="includes/reset.css.php" rel="stylesheet">
    <link href="includes/grid.css.php" rel="stylesheet">
    <link href="includes/collapsable_menu.css.php" rel="stylesheet">
    <link href="includes/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="http://bdtripp.com/portland_art_supply/images/favicon.ico">
<!--    <link href="includes/main.less.php" rel="stylesheet/less">-->
<!--    <script src="includes/less.js.php"></script>-->

</head>

<body>

<?php show_header_content($categoryName); ?>
<?php show_group_content($products); ?>
<?php show_footer_content(); ?>

</body>

</html>
