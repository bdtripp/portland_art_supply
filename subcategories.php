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
session_start();

require_once('includes/page_constants.php');
require_once('includes/art_constants.php');
require_once('includes/db_constants.php');
require_once('includes/ui_code.php');
require_once('includes/db_code.php');
require_once('includes/login_constants.php');
require_once('includes/utilities.php');
require_once('includes/shopping_cart_code.php');

$categoryID = $_GET[PRODUCT_CATEGORY_ID_FIELD];
$categoryName = $_GET[PRODUCT_CATEGORY_NAME_FIELD];

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

    <title>PAS | <?php echo $categoryName; ?></title>

    <link href="includes/reset.css.php" rel="stylesheet">
    <link href="includes/grid.css.php" rel="stylesheet">
    <link href="includes/collapsable_menu.css.php" rel="stylesheet">
    <link href="includes/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <!--    <link href="includes/main.less.php" rel="stylesheet/less">-->
    <!--    <script src="includes/less.js.php"></script>-->

</head>

<body>

<?php show_header_content($categoryName); ?>
<?php show_subcategory_content($categoryID, $categoryName); ?>
<?php show_footer_content(); ?>

</body>

</html>

