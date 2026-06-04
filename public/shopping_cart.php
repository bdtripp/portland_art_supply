<?php
require_once __DIR__ . '/../config.php';
session_start();

use PAS\Ui;
use PAS\PageConstants;
use PAS\DbConstants;
use PAS\Utilities;
use PAS\Cart;

$buttonClickedID = (int) Utilities::getPostValue("buttonID");
$newQuantity = (int) Utilities::getPostValue("quantity");
// id of the item that the quantity is being changed for
$idOfItemChanged = (int) Utilities::getPostValue("idOfItemChanged");
$ui = new Ui();
$cart = new Cart();

if (!empty($buttonClickedID)) {
    $cart->removeItemFromCart($buttonClickedID);
    exit();
}
if (!empty($newQuantity)) {
    $responseData = array(DbConstants::QUANTITY_FIELD => $cart->updateQuantityInSession($newQuantity, $idOfItemChanged),
        DbConstants::SUBTOTAL_FIELD => $cart->getItemSubtotal($idOfItemChanged), DbConstants::TOTAL_FIELD => $cart->getCartTotal()) ;
    echo json_encode($responseData);
    exit();
}

$activePage = PageConstants::SHOPPING_CART_PAGE_TITLE;

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

    <title>PAS | <?php echo $activePage; ?></title>

    <link href="css/reset.css.php" rel="stylesheet">
    <link href="css/grid.css.php" rel="stylesheet">
    <link href="css/collapsable_menu.css.php" rel="stylesheet">
    <link href="css/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <script type="text/javascript" src="js/pas.js.php"></script>

</head>

<body onload="init();">

<?php $ui->showHeaderContent($activePage); ?>
<?php $ui->showShoppingCartContent(); ?>
<?php $ui->showFooterContent(); ?>

</body>

</html>
