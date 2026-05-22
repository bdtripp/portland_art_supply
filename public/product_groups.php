<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 11/11/2018
 * Time: 2:44 PM
 */
session_start();

require_once __DIR__ . '/../config.php';
use PAS\PageConstants;
use PAS\Database;
use PAS\ArtConstants;
use PAS\DbConstants;
use PAS\Ui;
use PAS\LoginConstants;
use PAS\Utilities;
use PAS\Cart;

$categoryName = urldecode($_GET[PRODUCT_CATEGORY_NAME_FIELD]);
$subcategoryName = urldecode($_GET[PRODUCT_SUBCATEGORY_NAME_FIELD]);
$products = lookup_product_groups($categoryName, $subcategoryName);

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
    <script src="js/pas.js.php" type="text/javascript"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PAS | <?php echo $subcategoryName; ?></title>

    <link href="css/reset.css.php" rel="stylesheet">
    <link href="css/grid.css.php" rel="stylesheet">
    <link href="css/collapsable_menu.css.php" rel="stylesheet">
    <link href="css/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

</head>

<body onload="init();">

<?php show_header_content($categoryName); ?>
<?php show_group_content($products); ?>
<?php show_footer_content(); ?>

</body>

</html>
