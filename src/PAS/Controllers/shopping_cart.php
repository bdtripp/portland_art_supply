<?php
require_once __DIR__ . '/../../../config.php';

use PAS\View\LayoutUi;
use PAS\View\CartUi;
use PAS\Config\PageConstants;
use PAS\Config\DbConstants;
use PAS\Services\CartService;
use PAS\Infrastructure\Database;
use PAS\Repositories\AccountDataRepository;
use PAS\Services\SessionService;
use PAS\Support\RequestHelper;
use PAS\Support\NavigationHelper;

$db = new Database();
$accountRepo = new AccountDataRepository($db);
$sessionService = new SessionService($accountRepo);
$cartService = new CartService($sessionService);
$requestHelper = new RequestHelper();
$navigationHelper = new NavigationHelper($requestHelper);
$layoutUi = new LayoutUi($db, $cartService, $sessionService, $navigationHelper);
$cartUi = new CartUi($cartService);

$buttonClickedID = (int) $requestHelper->getPost("buttonID");
$newQuantity = (int) $requestHelper->getPost("quantity");
// id of the item that the quantity is being changed for
$idOfItemChanged = (int) $requestHelper->getPost("idOfItemChanged");

if (!empty($buttonClickedID)) {
    $cartService->removeItemFromCart($buttonClickedID);
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}
if (!empty($newQuantity)) {
    $responseData = array(DbConstants::QUANTITY_FIELD => $cartService->updateQuantityInSession($newQuantity, $idOfItemChanged),
        DbConstants::SUBTOTAL_FIELD => $cartService->getItemSubtotal($idOfItemChanged), DbConstants::TOTAL_FIELD => $cartService->getCartTotal()) ;
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

<?php $layoutUi->header($activePage); ?>
<?php $cartUi->shoppingCart(); ?>
<?php $layoutUi->footer(); ?>

</body>

</html>
