<?php
require_once __DIR__ . '/../../../config.php';

use PAS\Config\PageConstants;
use PAS\Repositories\AccountDataRepository;
use PAS\Infrastructure\Database;
use PAS\Services\CartService;
use PAS\Services\SessionService;
use PAS\Support\RequestHelper;
use PAS\Support\NavigationHelper;
use PAS\View\LayoutUi;

$activePage = PageConstants::ABOUT_PAGE_TITLE;

$db = new Database();

$accountRepo = new AccountDataRepository($db);

$sessionService = new SessionService($accountRepo);
$cartService = new CartService($sessionService);

$requestHelper = new RequestHelper();
$navigationHelper = new NavigationHelper($requestHelper);

$layoutUi = new LayoutUi($db, $cartService, $sessionService, $navigationHelper);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PAS | About</title>
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
    <body onload="init();">
        <?php $layoutUi->header($activePage); ?>
        <main>
            <section id="<?= PageConstants::ABOUT_SECTION_ID ?>">
                <h2>About Us</h2>
                <div id="<?= PageConstants::ABOUT_TEXT_ID ?>" class="<?= PageConstants::SEVEN_COLUMNS_CLASS ?>">
                    <p>
                        Portland Art Supply (PAS) was founded in 1975. Having its roots in the Northwest District of downtown
                        Portland as a small retailer of craft supplies, PAS has grown to become one of the Northwest's
                        largest art retailers.
                    </p><br>
                    <p>
                        Henry Fentworth had the inspiration to open a craft store after befriending a local artist and
                        hearing of their difficulty in finding quality painting supplies. Due to a tight budget and
                        a limited knowledge of business, he started off small, but it was not long before locals
                        began to rely on PAS for all of their art supply needs.
                    </p><br>
                    <p>
                        In the 1980s PAS saw a huge growth in sales and decided that it was time to make a move to
                        a larger location. PAS was relocated to the nearby suburb of Beaverton, Oregon. The larger space
                        allowed the store to supply a much larger variety of brands than ever before.
                    </p><br>
                    <p>
                        As e-commerce began to grow in popularity, PAS expanded its sales to the vast opportunities that
                        are to be found online. Now selling to as many as 64 countries, PAS has far outgrown the expectations
                        that Henry had ever foreseen for the humble store.
                    </p><br>
                    <p>
                        PAS continues to seek ways that it can continue to meet the demands and interests of an increasingly
                        diversified customer base, staying true to its roots while at the same time allowing for expansion
                        when it proves to be beneficial to its customers.
                    </p><br>
                    <p>We hope to continue to provide artists with the products that they love for many years to come!</p>
                </div>
                <div id="<?= PageConstants::ABOUT_IMAGE_DIV_ID ?>" class="<?= PageConstants::FIVE_COLUMNS_CLASS ?>">
                    <img src="images/about1.jpg" alt="An artist drawing plants in a notebook">
                    <img src="images/about2.jpg" alt="Artist getting paint from a palette">
                </div>
            </section>
        </main>
        <?php $layoutUi->footer(); ?>
    </body>
</html>
