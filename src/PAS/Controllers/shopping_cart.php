<?php
require_once __DIR__ . '/../../../config.php';

use PAS\View\LayoutUi;
use PAS\View\CartUi;
use PAS\Config\PageConstants;
use PAS\Config\CartConstants;
use PAS\Services\CartService;
use PAS\Infrastructure\Database;
use PAS\Repositories\AccountDataRepository;
use PAS\Services\SessionService;
use PAS\Services\CsrfService;
use PAS\Support\RequestHelper;
use PAS\Support\NavigationHelper;

$db = new Database();

$accountRepository = new AccountDataRepository($db);

$sessionService = new SessionService($accountRepository);
$cartService = new CartService($sessionService);
$csrfService = new CsrfService($sessionService);

$requestHelper = new RequestHelper();
$navigationHelper = new NavigationHelper($requestHelper);

$layoutUi = new LayoutUi($db, $cartService, $sessionService, $navigationHelper);
$cartUi = new CartUi($cartService);

$buttonClickedID = $requestHelper->getPostInt(CartConstants::BUTTON_ID_KEY);
$newQuantity = $requestHelper->getPostInt(CartConstants::QUANTITY_KEY);
// id of the item that the quantity is being changed for
$changedItemID = $requestHelper->getPostInt(CartConstants::CHANGED_ITEM_ID_KEY);

if (!empty($buttonClickedID) || !empty($newQuantity)) {
    $csrfService->guard($requestHelper);
}

if (!empty($buttonClickedID)) {
    $cartService->removeItemFromCart($buttonClickedID);
    $uri = str_replace(["\r", "\n"], '', $_SERVER['REQUEST_URI']);
    header("Location: $uri");
    exit();
}

if (!empty($newQuantity) && !empty($changedItemID)) {
    $responseData = [
        CartConstants::QUANTITY_KEY => $cartService->updateQuantityInSession($newQuantity, $changedItemID),
        CartConstants::SUBTOTAL_KEY => $cartService->getItemSubtotal($changedItemID),
        CartConstants::TOTAL_KEY => $cartService->getCartTotal()
    ];
    echo json_encode($responseData);
    exit();
}

$activePage = PageConstants::SHOPPING_CART_PAGE_TITLE;
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PAS | <?= e($activePage) ?></title>
        <link href="css/reset.css" rel="stylesheet">
        <link href="css/grid.css" rel="stylesheet">
        <link href="css/collapsable_menu.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-135450898-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-135450898-2');
        </script>
        <script>
            const CSRF_TOKEN = <?= json_encode($csrfService->getToken()) ?>;
        </script>
        <script type="text/javascript" src="js/pas.js.php"></script>
    </head>
    <body onload="init();">
        <?php $layoutUi->header($activePage); ?>
        <?php $cartUi->shoppingCart(); ?>
        <?php $layoutUi->footer(); ?>
    </body>
</html>
