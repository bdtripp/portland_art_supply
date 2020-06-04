<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 12/1/2018
 * Time: 7:52 AM
 */
session_start();

require_once('includes/ui_code.php');
require_once('includes/page_constants.php');
require_once('includes/db_code.php');
require_once ('includes/db_constants.php');
require_once('includes/login_constants.php');
require_once('includes/utilities.php');
require_once ('includes/shopping_cart_code.php');

$buttonClickedID = get_post_value("buttonID");
$newQuantity = get_post_value("quantity");
// id of the item that the quantity is being changed for
$idOfItemChanged = get_post_value("idOfItemChanged");

if (!empty($buttonClickedID)) {
    removeItemFromCart($buttonClickedID);
    exit();
}
if (!empty($newQuantity)) {
    $responseData = array(QUANTITY_FIELD => updateQuantityInSession($newQuantity, $idOfItemChanged),
        SUBTOTAL_FIELD => getItemSubtotal($idOfItemChanged), TOTAL_FIELD => getCartTotal()) ;
    echo json_encode($responseData);
    exit();
}

$activePage = SHOPPING_CART_PAGE_TITLE;

?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PAS | <?php echo $activePage; ?></title>

    <link href="includes/reset.css.php" rel="stylesheet">
    <link href="includes/grid.css.php" rel="stylesheet">
    <link href="includes/collapsable_menu.css.php" rel="stylesheet">
    <link href="includes/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="http://bdtripp.com/portland_art_supply/images/favicon.ico">
    <!--    <link href="includes/main.less.php" rel="stylesheet/less">-->
    <script type="text/javascript" src="includes/pas.js.php"></script>
    <!--    <script src="includes/less.js.php"></script>-->

</head>

<body>

<?php show_header_content($activePage); ?>
<?php show_shopping_cart_content(); ?>
<?php show_footer_content(); ?>

</body>

</html>
