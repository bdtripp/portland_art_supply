<?php
require_once __DIR__ . '/../../../config.php';

use PAS\Config\DbConstants;
use PAS\Repositories\ProductRepository;
use PAS\Repositories\AccountDataRepository;
use PAS\View\Ui;
use PAS\Infrastructure\Database;
use PAS\Services\CartService;
use PAS\Services\SessionService;

$categoryName = urldecode($_GET[DbConstants::PRODUCT_CATEGORY_NAME_FIELD]);
$subcategoryName = urldecode($_GET[DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD]);
$db = new Database();
$accountRepo = new AccountDataRepository($db);
$sessionService = new SessionService($accountRepo);
$cartService = new CartService($sessionService);
$ui = new Ui($db, $cartService);
$productRepository = new ProductRepository($db);
$products = $productRepository->getProductGroups($categoryName, $subcategoryName);

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
    <script src="js/pas.js.php" type="text/javascript"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PAS | <?php echo $subcategoryName; ?></title>

    <link href="css/reset.css.php" rel="stylesheet">
    <link href="css/grid.css.php" rel="stylesheet">
    <link href="css/collapsable_menu.css.php" rel="stylesheet">
    <link href="css/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

</head>

<body onload="init();">

<?php $ui->showHeaderContent($categoryName); ?>
<?php $ui->showGroupContent($products); ?>
<?php $ui->showFooterContent(); ?>

</body>

</html>
