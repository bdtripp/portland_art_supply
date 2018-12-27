<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/28/2018
 * Time: 5:42 PM
 *
 * TODO: in head, remove script link to local js file and uncomment the script link to the one on cdn
 * TODO: remove less.js.file
 *
 */

// TODO: change "To view our products" message so that it works for all categories

require_once('includes/page_constants.php');
require_once('includes/art_constants.php');
require_once('includes/db_constants.php');
require_once('includes/ui_code.php');
require_once('includes/db_code.php');
require_once('includes/login_constants.php');
require_once('includes/utilities.php');
require_once('includes/shopping_cart_code.php');

session_start();

$categoryID = $_GET[PRODUCT_CATEGORY_ID_FIELD];
$categoryName = $_GET[PRODUCT_CATEGORY_NAME_FIELD];

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PAS | <?php echo $categoryName; ?></title>

    <link href="includes/reset.css.php" rel="stylesheet">
    <link href="includes/grid.css.php" rel="stylesheet">
    <link href="includes/collapsable_menu.css.php" rel="stylesheet">
    <link href="includes/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="http://bdtripp.com/portland_art_supply/images/favicon.png">
<!--    <link href="includes/main.less.php" rel="stylesheet/less">-->
<!--    <script src="includes/less.js.php"></script>-->

</head>

<body>

<?php show_header_content($categoryName); ?>
<?php show_subcategory_content($categoryID, $categoryName); ?>
<?php show_footer_content(); ?>

</body>

</html>

