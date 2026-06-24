<?php
require_once __DIR__ . '/../../../config.php';

use PAS\View\LayoutUi;
use PAS\View\CartUi;
use PAS\Config\PageConstants;
use PAS\Config\DbConstants;
use PAS\Config\CartConstants;
use PAS\Services\CartService;
use PAS\Infrastructure\Database;
use PAS\Repositories\AccountDataRepository;
use PAS\Services\SessionService;
use PAS\Services\CsrfService;
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
$csrfService = new CsrfService($sessionService);

$buttonClickedID = $requestHelper->getPostInt("buttonID");
$newQuantity = $requestHelper->getPostInt("quantity");
// id of the item that the quantity is being changed for
$idOfItemChanged = $requestHelper->getPostInt("idOfItemChanged");

if (!empty($buttonClickedID) || !empty($newQuantity)) {
    $csrfService->guard($requestHelper);
}

if (!empty($buttonClickedID)) {
    $cartService->removeItemFromCart($buttonClickedID);
    $uri = str_replace(["\r", "\n"], '', $_SERVER['REQUEST_URI']);
    header("Location: $uri");
    exit();
}
if (!empty($newQuantity) && !empty($idOfItemChanged)) {
    $responseData = [
        CartConstants::QUANTITY_KEY => $cartService->updateQuantityInSession($newQuantity, $idOfItemChanged),
        CartConstants::SUBTOTAL_KEY => $cartService->getItemSubtotal($idOfItemChanged),
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

    <title>PAS | <?= e($activePage) ?></title>

    <link href="css/reset.css" rel="stylesheet">
    <link href="css/grid.css" rel="stylesheet">
    <link href="css/collapsable_menu.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
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
