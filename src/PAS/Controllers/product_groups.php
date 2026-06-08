<?php
require_once __DIR__ . '/../../../config.php';

use PAS\Infrastructure\Database;
use PAS\Config\DbConstants;
use PAS\View\Ui;

$categoryName = urldecode($_GET[DbConstants::PRODUCT_CATEGORY_NAME_FIELD]);
$subcategoryName = urldecode($_GET[DbConstants::PRODUCT_SUBCATEGORY_NAME_FIELD]);
$ui = new Ui();
$db = new Database();
$products = $db->lookupProductGroups($categoryName, $subcategoryName);

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
