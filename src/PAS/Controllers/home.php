<?php
require_once __DIR__ . '/../../../config.php';

use PAS\Config\PageConstants;
use PAS\Repositories\AccountDataRepository;
use PAS\Repositories\CategoryRepository;
use PAS\View\LayoutUi;
use PAS\Infrastructure\Database;
use PAS\Services\CartService;
use PAS\Services\SessionService;
use PAS\Support\RequestHelper;
use PAS\Support\NavigationHelper;

$activePage = PageConstants::HOME_PAGE_TITLE;

$db = new Database();

$accountRepository = new AccountDataRepository($db);
$categoryRepository = new CategoryRepository($db);

$sessionService = new SessionService($accountRepository);
$cartService = new CartService($sessionService);

$requestHelper = new RequestHelper();
$navigationHelper = new NavigationHelper($requestHelper);

$layoutUi = new LayoutUi($categoryRepository, $cartService, $sessionService, $navigationHelper);
?>

<!doctype html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>PAS | Home</title>
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
    <?php $layoutUi->header($activePage); ?>
      <main id="home">
        <img src="images/large_paint.png"/>
        <div class="image_overlay"></div>
        <h2>Finest<br>selection<br> in Portland.</h2>
      </main>
    <?php $layoutUi->footer(); ?>
  </body>
</html>
