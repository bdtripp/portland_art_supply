<?php
require_once __DIR__ . '/../../../config.php';

use PAS\Config\DbConstants;
use PAS\Repositories\ProductRepository;
use PAS\Repositories\AccountDataRepository;
use PAS\View\LayoutUi;
use PAS\View\ProductUi;
use PAS\Infrastructure\Database;
use PAS\Services\CartService;
use PAS\Services\SessionService;
use PAS\Support\RequestHelper;
use PAS\Support\NavigationHelper;

$categoryName = urldecode($_GET[DbConstants::PRODUCT_CATEGORY_NAME_FIELD]);
$subcategoryName = urldecode($_GET[DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD]);

$db = new Database();

$accountRepository = new AccountDataRepository($db);
$productRepository = new ProductRepository($db);
$products = $productRepository->getProductGroups($categoryName, $subcategoryName);

$sessionService = new SessionService($accountRepository);
$cartService = new CartService($sessionService);

$requestHelper = new RequestHelper();
$navigationHelper = new NavigationHelper($requestHelper);

$layoutUi = new LayoutUi($db, $cartService, $sessionService, $navigationHelper);
$productUi = new ProductUi();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PAS | <?= e($subcategoryName) ?></title>
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
        <script src="js/pas.js.php" type="text/javascript"></script>
    </head>
    <body>
        <?php $layoutUi->header($categoryName); ?>
        <?php $productUi->groupGrid($products); ?>
        <?php $layoutUi->footer(); ?>
    </body>
</html>
