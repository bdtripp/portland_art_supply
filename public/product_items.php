<?php
require_once __DIR__ . '/../config.php';
session_start();

use PAS\Database;
use PAS\DbConstants;
use PAS\Ui;
use PAS\Cart;
use PAS\Utilities;

$id = Utilities::getPostValue(DbConstants::PRODUCT_ITEM_ID_FIELD);
$groupDescription = Utilities::getPostValue(DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD);
$category = Utilities::getPostValue(DbConstants::PRODUCT_CATEGORY_NAME_FIELD);
$subcategory = Utilities::getPostValue(DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD);
$groupCode = Utilities::getPostValue(DbConstants::PRODUCT_GROUP_CODE_FIELD);
$color = Utilities::getPostValue(DbConstants::PRODUCT_COLOR_NAME_FIELD);
$size = Utilities::getPostValue(DbConstants::PRODUCT_SIZE_DESCRIPTION_FIELD);
$price = Utilities::getPostValue(DbConstants::PRODUCT_ITEM_PRICE_FIELD);
$quantity = Utilities::getPostValue(DbConstants::QUANTITY_FIELD);
$db = new Database();
$cart = new Cart();
$ui = new Ui();

if (!empty($id)) {
    $cart->addItemToCart(
        (int) html_entity_decode(urldecode($id)), 
        html_entity_decode(urldecode($category)),
        html_entity_decode(urldecode($subcategory)), 
        html_entity_decode(urldecode($groupCode)), 
        html_entity_decode(urldecode($groupDescription)),
        html_entity_decode(urldecode($color)), 
        html_entity_decode(urldecode($size)),
        (float) html_entity_decode(urldecode($price)), 
        (int) html_entity_decode(urldecode($quantity))
    );
    exit();
}

$categoryName = urldecode($_GET[DbConstants::PRODUCT_CATEGORY_NAME_FIELD]);
$subcategoryName = urldecode($_GET[DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD]);
$groupCode = urldecode($_GET[DbConstants::PRODUCT_GROUP_CODE_FIELD]);
$groupID = (int) urldecode($_GET[DbConstants::PRODUCT_GROUP_ID_FIELD]);
$productGroup = $db->lookupGroup($groupID);
$productItems = $db->lookupItems($groupID);

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

    <link href="css/reset.css.php" rel="stylesheet">
    <link href="css/grid.css.php" rel="stylesheet">
    <link href="css/collapsable_menu.css.php" rel="stylesheet">
    <link href="css/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <script type="text/javascript">
        var groupCode = '<?php echo $groupCode; ?>';
        var productItems = <?php echo json_encode($productItems); ?>;
        var category = '<?php echo $categoryName; ?>';
        var subcategory = '<?php echo $subcategoryName; ?>';
        var groupDescription = '<?php echo addslashes($productGroup->description) ?>';
    </script>
    <script src="js/pas.js.php" type="text/javascript"></script>

</head>

<body onload="init();">

<?php $ui->showHeaderContent($categoryName); ?>
<?php $ui->showItemContent($productGroup, $categoryName, $subcategoryName); ?>
<?php $ui->showFooterContent(); ?>

</body>

</html>

