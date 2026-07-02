<?php
require_once __DIR__ . '/../../../config.php';

use PAS\Infrastructure\Database;
use PAS\Config\DbConstants;
use PAS\Config\CartConstants;
use PAS\View\LayoutUi;
use PAS\View\ProductUi;
use PAS\Services\CartService;
use PAS\Repositories\CategoryRepository;
use PAS\Repositories\ProductRepository;
use PAS\Repositories\AccountRepository;
use PAS\Services\SessionService;
use PAS\Services\CsrfService;
use PAS\Support\RequestHelper;
use PAS\Support\NavigationHelper;

$db = new Database();

$accountRepository = new AccountRepository($db);
$productRepository = new ProductRepository($db);
$categoryRepository = new CategoryRepository($db);

$sessionService = new SessionService($accountRepository);
$cartService = new CartService($sessionService);
$csrfService = new CsrfService($sessionService);

$requestHelper = new RequestHelper();
$navigationHelper = new NavigationHelper($requestHelper);

$layoutUi = new LayoutUi($categoryRepository, $cartService, $sessionService, $navigationHelper);
$productUi = new ProductUi();

$id = $requestHelper->getPostInt(DbConstants::PRODUCT_ITEM_ID_FIELD);
$category = $requestHelper->getPostString(DbConstants::PRODUCT_CATEGORY_NAME_FIELD);
$subcategory = $requestHelper->getPostString(DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD);
$groupCode = $requestHelper->getPostString(DbConstants::PRODUCT_GROUP_CODE_FIELD);
$groupDescription = $requestHelper->getPostString(DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD);
$color = $requestHelper->getPostString(DbConstants::PRODUCT_COLOR_NAME_FIELD);
$size = $requestHelper->getPostString(DbConstants::PRODUCT_SIZE_DESCRIPTION_FIELD);
$price = $requestHelper->getPostFloat(DbConstants::PRODUCT_ITEM_PRICE_FIELD);
$quantity = $requestHelper->getPostInt(CartConstants::QUANTITY_KEY);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrfService->guard($requestHelper);
}

if (!empty($id)) {
    $cartService->addItemToCart(
        $id,
        $category ?? '',
        $subcategory ?? '',
        $groupCode ?? '',
        $groupDescription ?? '',
        $color ?? '',
        $size ?? '',
        $price ?? 0.0,
        $quantity ?? 1
    );
    exit();
}

$categoryName = urldecode($_GET[DbConstants::PRODUCT_CATEGORY_NAME_FIELD]);
$subcategoryName = urldecode($_GET[DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD]);
$groupCode = urldecode($_GET[DbConstants::PRODUCT_GROUP_CODE_FIELD]);
$groupId = (int) urldecode($_GET[DbConstants::PRODUCT_GROUP_ID_FIELD]);
$productGroup = $productRepository->getGroupById($groupId);

if ($productGroup === null) {
    die('Invalid product group');
}

$productItems = $productRepository->getItemsByGroupId($groupId);
?>

<!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description"
              content="View details for <?= e($productGroup->description) ?> at Portland Art Supply. See current pricing and photos of products.">
        <title>PAS | <?= e($groupCode) ?></title>
        <link href="css/reset.css" rel="stylesheet">
        <link href="css/grid.css" rel="stylesheet">
        <link href="css/collapsable_menu.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link rel="icon" href="images/favicon.ico">
        <script>
            const CSRF_TOKEN = <?= json_encode($csrfService->getToken()) ?>;
            var category = <?= json_encode($categoryName) ?>;
            var subcategory = <?= json_encode($subcategoryName) ?>;
            var groupCode = <?= json_encode($groupCode) ?>;
            var groupDescription = <?= json_encode($productGroup->description) ?>;
            var productItems = <?= json_encode($productItems); ?>;
        </script>
        <script src="js/pas.js.php" defer></script>
    </head>
    <body>
        <?php $layoutUi->header(); ?>
        <?php $productUi->itemDetail($productGroup, $categoryName, $subcategoryName); ?>
        <?php $layoutUi->footer(); ?>
    </body>
</html>
