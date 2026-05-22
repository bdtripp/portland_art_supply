<?php
session_start();

require_once __DIR__ . '/../config.php';
use PAS\Ui;
use PAS\PageConstants;
use PAS\DbConstants;
use PAS\LoginConstants;
use PAS\Utilities;
use PAS\Cart;

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

<?php show_header_content($activePage); ?>
<?php show_shopping_cart_content(); ?>
<?php show_footer_content(); ?>

</body>

</html>
