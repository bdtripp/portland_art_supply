<?php
require_once __DIR__ . '/../../../config.php';

use PAS\Config\DbConstants;
use PAS\Repositories\ProductRepository;
use PAS\Repositories\AccountRepository;
use PAS\Repositories\CategoryRepository;
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

$accountRepository = new AccountRepository($db);
$productRepository = new ProductRepository($db);
$categoryRepository = new CategoryRepository($db);

$sessionService = new SessionService($accountRepository);
$cartService = new CartService($sessionService);

$requestHelper = new RequestHelper();
$navigationHelper = new NavigationHelper($requestHelper);

$layoutUi = new LayoutUi($categoryRepository, $cartService, $sessionService, $navigationHelper);
$productUi = new ProductUi();

$products = $productRepository->getProductGroups($categoryName, $subcategoryName);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description"
              content="Browse top product lines in <?= e($categoryName) ?> › <?= e($subcategoryName) ?> at Portland Art Supply to find exactly what you need.">
        <title>PAS | <?= e($subcategoryName) ?></title>
        <link href="css/reset.css" rel="stylesheet">
        <link href="css/grid.css" rel="stylesheet">
        <link href="css/collapsable_menu.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link rel="icon" href="images/favicon.ico">
        <script src="js/pas.js.php" defer></script>
    </head>
    <body>
        <?php $layoutUi->header(); ?>
        <?php $productUi->groupGrid($products); ?>
        <?php $layoutUi->footer(); ?>
    </body>
</html>
