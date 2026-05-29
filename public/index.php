<?php
require_once __DIR__ . '/../config.php';
session_start();

use PAS\Ui;
use PAS\PageConstants;

$activePage = PageConstants::HOME_PAGE_TITLE;

$ui = new Ui();
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

<?php $ui->showHeaderContent($activePage); ?>
  
  <main id="home">
    <img src="images/large_paint.png"></img>
    <div class="image_overlay"></div>
    <h2>Finest<br>selection<br> in Portland.</h2>

  </main>

<?php $ui->showFooterContent(); ?>

</body>

</html>
