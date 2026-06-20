<?php
require_once __DIR__ . '/../../../config.php';

use PAS\Infrastructure\Database;
use PAS\Config\DbConstants;
use PAS\Config\SecurityConstants;
use PAS\View\LayoutUi;
use PAS\View\ProductUi;
use PAS\Services\CartService;
use PAS\Repositories\ProductRepository;
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
$productUi = new ProductUi();
$productRepository = new ProductRepository($db);
$csrfService = new CsrfService($sessionService);

$id = $requestHelper->getPostInt(DbConstants::PRODUCT_ITEM_ID_FIELD);
$groupDescription = $requestHelper->getPostString(DbConstants::PRODUCT_GROUP_DESCRIPTION_FIELD);
$category = $requestHelper->getPostString(DbConstants::PRODUCT_CATEGORY_NAME_FIELD);
$subcategory = $requestHelper->getPostString(DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD);
$groupCode = $requestHelper->getPostString(DbConstants::PRODUCT_GROUP_CODE_FIELD);
$color = $requestHelper->getPostString(DbConstants::PRODUCT_COLOR_NAME_FIELD);
$size = $requestHelper->getPostString(DbConstants::PRODUCT_SIZE_DESCRIPTION_FIELD);
$price = $requestHelper->getPostFloat(DbConstants::PRODUCT_ITEM_PRICE_FIELD);
$quantity = $requestHelper->getPostInt(DbConstants::QUANTITY_FIELD);

if (!empty($id)) {
    $csrfService->guard($requestHelper);

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

    <title>PAS | <?= e($groupCode) ?></title>

    <link href="css/reset.css.php" rel="stylesheet">
    <link href="css/grid.css.php" rel="stylesheet">
    <link href="css/collapsable_menu.css.php" rel="stylesheet">
    <link href="css/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <script type="text/javascript">
        const CSRF_TOKEN = <?= json_encode($csrfService->getToken()) ?>;
        var groupCode = <?= json_encode($groupCode) ?>;
        var productItems = <?= json_encode($productItems); ?>;
        var category = <?= json_encode($categoryName) ?>;
        var subcategory = <?= json_encode($subcategoryName) ?>;
        var groupDescription = <?= json_encode($productGroup->description) ?>;
    </script>
    <script src="js/pas.js.php" type="text/javascript"></script>

</head>

<body onload="init();">

<?php $layoutUi->header($categoryName); ?>
<?php $productUi->itemDetail($productGroup, $categoryName, $subcategoryName); ?>
<?php $layoutUi->footer(); ?>

</body>

</html>
