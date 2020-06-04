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

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PAS | About</title>

    <link href="includes/reset.css.php" rel="stylesheet">
    <link href="includes/grid.css.php" rel="stylesheet">
    <link href="includes/collapsable_menu.css.php" rel="stylesheet">
    <link href="includes/main.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="http://bdtripp.com/portland_art_supply/images/favicon.ico">
<!--    <link href="includes/main.less.php" rel="stylesheet/less">-->
<!--    <script src="includes/less.js.php"></script>-->

</head>

<body>

<?php show_header_content($activePage); ?>

<main>
    <section id="<?php echo ABOUT_SECTION_ID; ?>">
        <h2>About Us</h2>

        <div id="<?php echo ABOUT_TEXT_ID; ?>" class="<?php echo SEVEN_COLUMNS_CLASS; ?>">
            <p>Portland Art Supply was founded in 1985 as a small upstart art supply in the Portland, Oregon area.
                At the time, the retail landscape of art materials was dominated by independent “Mom & Pop” storefronts
                that were often a mix of stationery, hardware, and office supplies. Catalog companies were also a major
                player as the internet was in its infancy as a commercial platform. PAS carved out its little corner in
                the northwest.</p><br>

            <p>The early years of PAS included segues into wholesale distribution, light manufacturing, sign supplies,
                architectural finishes (aka house paint) and exclusive importation and distribution of a boutique European
                oil paint. None of these partner businesses were particularly successful except for the oil paint
                distribution and all were eventually abandoned in an effort to refocus on retail.</p><br>

            <p>As the mid-nineties approached, consolidation in the manufacturing and distribution of art materials began
                to infiltrate an otherwise largely cottage industry. The bigger players (with bigger wallets) in the office
                supply, stationery and hardware trades began to dominate and overwhelm the small, independent retailers. It
                was then time for PAS to get bigger or get pushed out.</p><br>

            <p>PAS began its expansion in the mid-nineties and continued incrementally adding stores, here and there, over
                the next several years. The early years of expansion were exceptionally difficult as, there was no expertise
                in developing remote locations, no meaningful company infrastructure, no market research, no advertising
                campaigns and no cohesive long-term business plan. The saving grace was PAS’s ability to connect with
                artists and stir excitement for the underdog. Over time, and after learning from a lot of mistakes, PAS
                began to hit its stride and count more successes than failures. By the early 2000’s, the PAS model gained
                refinement and growth into areas such as children’s art and school supplies, eclectic and novelty goods and
                other non-traditional fine art related materials. This refinement and growth began to shape the PAS you see
                today. PAS was becoming not only a credible source for high-quality fine art materials but a destination for
                the novice, student, hobbyist and just about anyone looking for something unusual or just plain fun.</p><br>

<!--            <p>In 2009, A&C’s founder and then President, Larry Adlerstein, sold 48% of Artist & Craftsman Supply to its-->
<!--                employees. Thus, the Artist & Craftsman Supply Employee Stock Ownership Plan Trust (ESOP) was formed. The-->
<!--                next seven years saw significant expansion for A&C. By the fall of 2016, a total of 34 brick and mortar-->
<!--                locations, as well as an online store, had been created.</p><br>-->
<!---->
<!--            <p>On December 30, 2016, A&C acquired the remaining shares of the company from the founder and became a 100%-->
<!--                Employee-Owned Company. Today, A&C stands as one of the largest art material suppliers in the United States.-->
<!--                Our goal is to continue to shape our company as a vital resource in the support of the creative spirit.-->
<!--                As employee-owners or those soon to be, there is immeasurable satisfaction and opportunity ahead. There is-->
<!--                work to be done and challenges to be met, but together as a family of employee owners, we are only limited-->
<!--                by the boundaries of our imagination.</p><br>-->

            <p>PAS is proud to be an Oregon-based company and equally as proud to be ‘local’ to over 30 communities
                nationwide and those who join us online.</p><br>

            <p>We are America’s local art supply store!</p>
        </div>
        <div id="<?php echo ABOUT_IMAGE_DIV_ID; ?>" class="<?php echo FIVE_COLUMNS_CLASS; ?>">
            <img src="images/about_owner.jpg" alt="Owner of Portland Art Supply">
            <img src="images/about_employee.jpg" alt="Employee of Portland Art Supply">
        </div>
    </section>
</main>

<?php show_footer_content(); ?>

</body>

</html>
