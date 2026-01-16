<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 12/1/2018
 * Time: 7:52 AM
 */
session_start();

require_once('includes/ui_code.php');
require_once('includes/page_constants.php');
require_once('includes/db_code.php');
require_once ('includes/db_constants.php');
require_once('includes/login_constants.php');
require_once('includes/utilities.php');
require_once('includes/shopping_cart_code.php');

$activePage = ABOUT_PAGE_TITLE;

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

    <title>PAS | About</title>

    <link href="includes/reset.css.php" rel="stylesheet">
    <link href="includes/grid.css.php" rel="stylesheet">
    <link href="includes/collapsable_menu.css.php" rel="stylesheet">
    <link href="includes/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <!--    <link href="includes/main.less.php" rel="stylesheet/less">-->
    <!--    <script src="includes/less.js.php"></script>-->

</head>

<body>

<?php show_header_content($activePage); ?>

<main>
    <section id="<?php echo ABOUT_SECTION_ID; ?>">
        <h2>About Us</h2>

        <div id="<?php echo ABOUT_TEXT_ID; ?>" class="<?php echo SEVEN_COLUMNS_CLASS; ?>">
            <p>
                Portland Art Supply (PAS) was founded in 1975. Having its roots in the Northwest District of downtown
                Portland as a small retailer of craft supplies, PAS has grown to becoming one of the Northwest'
                largets art retailers.
            </p><br>

            <p>
                Henry Fentworth had the inspiration to open a craft store after befriending a local artist and
                hearing of their difficulty in finding quality painting supplies. Due to a tight budget and
                a limited knowledge of business, he started off small, but it was not long before locals
                began to rely on PAS for all of their art supply needs.
            </p><br>

            <p>
                In the 1980s PAS saw a huge growth in sells and decided that it was time to make a move to
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
                when it proves to be beneficial to it's customers.
            </p><br>

            <p>We hope to continue to provide artist's with the products that they love for many years to come!</p>
        </div>
        <div id="<?php echo ABOUT_IMAGE_DIV_ID; ?>" class="<?php echo FIVE_COLUMNS_CLASS; ?>">
            <img src="images/about1.jpg" alt="An artist drawing plants in a notebook">
            <img src="images/about2.jpg" alt="Artist getting paint from a palette">
        </div>
    </section>
</main>

<?php show_footer_content(); ?>

</body>

</html>
