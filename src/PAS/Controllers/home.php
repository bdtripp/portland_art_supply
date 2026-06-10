<?php
require_once __DIR__ . '/../../../config.php';

use PAS\Config\PageConstants;
use PAS\Repositories\AccountDataRepository;
use PAS\View\LayoutUi;
use PAS\Infrastructure\Database;
use PAS\Services\CartService;
use PAS\Services\SessionService;

$activePage = PageConstants::HOME_PAGE_TITLE;
$db = new Database();
$accountRepo = new AccountDataRepository($db);
$sessionService = new SessionService($accountRepo);
$cartService = new CartService($sessionService);
$layoutUi = new LayoutUi($db, $cartService);
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

    <title>PAS | Home</title>

    <link href="css/reset.css.php" rel="stylesheet">
    <link href="css/grid.css.php" rel="stylesheet">
    <link href="css/collapsable_menu.css.php" rel="stylesheet">
    <link href="css/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
</head>

<body onload="init();">

<?php $layoutUi->header($activePage); ?>

  <main id="home">
    <img src="images/large_paint.png"></img>
    <div class="image_overlay"></div>
    <h2>Finest<br>selection<br> in Portland.</h2>

  </main>

<?php $layoutUi->footer(); ?>

</body>

</html>
