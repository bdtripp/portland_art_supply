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
require_once('includes/db_constants.php');
require_once('includes/login_constants.php');
require_once('includes/utilities.php');
require_once('includes/shopping_cart_code.php');

$activePage = HOME_PAGE_TITLE;

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

    <title>PAS | Home</title>

    <link href="includes/reset.css.php" rel="stylesheet">
    <link href="includes/grid.css.php" rel="stylesheet">
    <link href="includes/collapsable_menu.css.php" rel="stylesheet">
    <link href="includes/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
</head>

<body>

<?php show_header_content($activePage); ?>
  
  <main id="home">
    <div class="image_overlay"></div>
    <img src="images/large_paint.png"></img>
    <div class="image_overlay"></div>
    <h2>Finest<br>selection<br> in Portland.</h2>

  </main>

<!-- <img src="images/large_ad.jpg" class="hide_in_mobile" alt="Closeout Sale! 40% Off Jacquard Procion MX Dye">
<img src="images/small_ad_1.jpg" class="show_in_mobile" alt="Closeout Sale!">
<img src="images/small_ad_2.jpg" class="show_in_mobile" alt="40% Off Jacquard Procion MX Dye"> -->

<?php show_footer_content(); ?>

</body>

</html>
