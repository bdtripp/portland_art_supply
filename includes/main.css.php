<?php

header('Content-Type: text/css');
?>
*/
/* Link to color palette:

https://color.adobe.com/create/color-wheel/?base=2&rule=Compound&selected=3&name=My%20Color%20Theme&mode=rgb&rgbvalues=0.054901960784313725,0.1411764705882353,0.8,0.24,0.2816842105262822,0.6,0,0.6421052631576458,1,1,0.5664583333332303,0.25,0.8,0.27879999999995564,0.07999999999999999&swatchOrder=0,1,2,3,4

*/
/* MIXINS */
/* COLOR PALETTE */
/*
 * Classes
 */
.clearfloat {
  clear: both;
}
.price_display {
  color: red;
}
.required {
  color: red;
}
/*===============================
===== MOBILE CSS CODE AND UP ======
===============================*/
.hide_in_mobile {
  display: none;
}
html {
  overflow: auto;
}
html body {
  font-family: 'Open Sans', sans-serif;
  overflow: auto;
  /*--------HEADER STYLE------*/
  /*--------MAIN STYLE------*/
  /*--------FOOTER STYLE------*/
}
html body img {
  max-width: 100%;
  height: auto;
  vertical-align: middle;
}
html body header {
  font-size: 1.2rem;
  letter-spacing: .07rem;
  position: relative;
  /*--------NAV STYLE------*/
}
html body header h1 {
  padding: 20px 0 20px 3%;
  font-family: 'Arvo', serif;
  /* This is a Google Font */
  color: white;
  background-color: #ff9040;
  font-size: 1rem;
}
html body header h1#no_wrap_pas {
  display: none;
}
html body header label.menu-icon {
  transform: translateY(35%);
  padding: 20px 15px;
}
html body header ul.header_links {
  float: right;
  position: absolute;
  top: 0;
  right: 5px;
  transform: translateY(70%);
}
html body header ul.header_links li {
  display: inline-block;
  vertical-align: middle;
}
html body header ul.header_links li a {
  padding: 0;
  text-decoration: none;
  color: black;
}
html body header ul.header_links li a.shopping_cart_icon {
  position: relative;
  display: flex;
}
html body header ul.header_links li a.shopping_cart_icon p#cart_count_display {
  position: absolute;
  top: 33%;
  left: 60%;
  transform: translate(-50%, -50%);
  font-size: .8rem;
  font-weight: bolder;
}
html body header ul.header_links li a#username_display {
  font-size: .8rem;
  margin-bottom: 3px;
  display: block;
}
html body header ul.header_links li a#login_link {
  margin-right: 10px;
  font-size: 1rem;
  margin: 0;
}
html body header nav ul {
  width: 94%;
  margin: 0 auto;
}
html body header nav ul li {
  text-align: center;
  border-radius: 5px;
}
html body header nav ul li:hover {
  background-color: #EEE;
}
html body header nav ul li.active {
  /* This style identifies the page the user is currently on */
  background-color: #DDD;
}
html body header nav ul li a {
  text-decoration: none;
  font-size: 1.5rem;
  color: black;
  display: block;
  padding: 6px 0;
  margin: 1px 0;
}
html body header nav ul li a:hover {
  opacity: .8;
}
html body main {
  text-align: center;
  border-top: 1px dotted #ff9040;
  /* The style below hides the dotted border when the navigation menu is collapsed */
  margin-top: -1px;
  letter-spacing: .1rem;
  overflow: hidden;
}
html body main h2 {
  font-size: 2rem;
  margin: 20px auto;
  color: #cc4714;
  font-weight: bold;
  clear: both;
  max-width: 97%;
}
html body main section {
  /*****************************
                * Style for subcategories.php
                *****************************/
  /*****************************
                 * Style for product_group.php
                 *****************************/
  /*****************************
                * Style for product_items.php
                *****************************/
  /*****************************
                * Style for shopping_cart.php
                *****************************/
  /*****************************
                * Style for about.php
                *****************************/
}
html body main section input {
  padding: 5px 3px;
}
html body main section.sub_intro {
  margin: 20px auto 15px auto;
  line-height: 130%;
  width: 95%;
  text-align: center;
  font-size: 1.1rem;
}
html body main section.lg_image {
  /* The image used here is 1200 x 799 pixels */
  background-image: url(../images/paint2.jpg);
  background-size: cover;
  background-position: center;
  height: 350px;
}
html body main section ul li a {
  text-decoration: none;
  font-size: 1.5rem;
  display: block;
  margin: 7px auto;
  padding: 3px;
  border-radius: 3px;
  color: #cc4714;
  box-shadow: 2px 2px 12px #444;
}
html body main section#product_groups div.group_row {
  overflow: hidden;
}
html body main section#product_groups div.product_group {
  padding: 20px 0 0 0;
  box-shadow: 5px 5px 20px #AAA;
  margin: 15px auto;
  border-radius: 5px;
}
html body main section#product_groups div.product_group a.group_description_text {
  max-width: 97%;
  margin: 0 auto;
  text-decoration: none;
  color: black;
  font-size: 1.2rem;
  display: block;
  padding: 0 0 5px 0;
}
html body main section#item_wrapper {
  overflow: hidden;
}
html body main section#item_wrapper h2#non_mobile_version {
  display: none;
}
html body main section#item_wrapper div#item_details p#group_info {
  max-width: 97%;
  margin: 20px auto;
  display: none;
}
html body main section#item_wrapper div#item_details div#item_options {
  overflow: hidden;
}
html body main section#item_wrapper div#item_details div#item_options div#item_options_right_col {
  margin: 20px 0;
}
html body main section#item_wrapper div#item_details div#item_options div#item_options_right_col p#price span.price_display {
  font-size: 1.2rem;
}
html body main section#item_wrapper div#item_details div#item_options div#item_options_right_col div#drop_down_options div {
  margin: 15px 0;
}
html body main section#item_wrapper div#item_details div#item_options div#item_options_right_col div#drop_down_options div p {
  display: inline;
}
html body main section#item_wrapper div#item_details div#item_options div#item_options_right_col div#drop_down_options div#color {
  white-space: nowrap;
}
html body main section#item_wrapper div#item_details div#color_thumbnails {
  line-height: 0;
  margin-bottom: 20px;
}
html body main section#item_wrapper div#item_details div#color_thumbnails img {
  border: 1px solid black;
  border-radius: 3px;
  margin: 2px;
}
html body main section.products {
  margin: 0 auto;
}
html body main section#cart_items div.cart_item {
  overflow: hidden;
  box-shadow: 5px 5px 20px #AAA;
  margin: 15px auto;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  font-size: .8rem;
  width: 97%;
}
html body main section#cart_items div.cart_item img {
  float: left;
  width: 28%;
}
html body main section#cart_items div.cart_item div.cart_item_info {
  padding: 10px 1%;
  width: 70%;
}
html body main section#cart_items div.cart_item div.cart_item_info p,
html body main section#cart_items div.cart_item div.cart_item_info input {
  margin: 5px 0;
}
html body main section#cart_items div.cart_item div.cart_item_info div.cart_item_specs p:first-child {
  margin-bottom: 10px;
}
html body main section#cart_items div.cart_item div.cart_item_info div.quantity_and_subtotal {
  overflow: hidden;
}
html body main section#cart_items div.cart_item div.cart_item_info div.quantity_and_subtotal div.quantity {
  margin: 0 0 10px 0;
}
html body main section#cart_items div.cart_item div.cart_item_info div.quantity_and_subtotal div.quantity p {
  display: inline;
}
html body main section#cart_items div.cart_item div.cart_item_info p.price_display {
  margin: 10px 0;
}
html body main section#cart_items div.cart_item input.remove_button {
  margin: 0 0 10px 0;
}
html body main section#cart_items p#total_display {
  margin: 20px 0;
  font-size: 1rem;
}
html body main section#cart_items input#checkout_button {
  margin-bottom: 20px;
}
html body main section#about {
  margin-bottom: 50px;
  overflow: auto;
}
html body main section#about div#about_text {
  text-align: left;
  margin-bottom: 40px;
}
html body main section#about div#about_text p {
  width: 90%;
  margin: 0 auto;
}
html body main section#about div#about_images img {
  margin-bottom: 20px;
}
html body footer {
  /* The image used here is 1366 x 911 pixels */
  background-image: url(../images/paint.jpg);
  background-size: cover;
  background-position: center;
  height: auto;
  color: white;
  font-weight: bold;
  font-size: .8rem;
}
html body footer div {
  width: 100%;
  margin: 0 auto;
  padding: 5px 0;
  background-color: #222;
  opacity: .9;
}
html body footer div section {
  margin-top: 15px;
  text-align: center;
}
html body footer div section.hours ul li,
html body footer div section.address ul li {
  margin: 5px 0;
}
html body footer div section.hours {
  padding: 10px 0;
  letter-spacing: .06rem;
  margin-top: 0;
}
html body footer div section.hours li:nth-child(odd) {
  /* This style applies to every other list item */
  margin-top: 10px;
}
html body footer div section.address {
  letter-spacing: .04rem;
}
html body footer div section.address a {
  text-decoration: none;
  color: white;
}
html body footer div section.address a.phone_mobile {
  /* This is the style for the tappable phone link in mobile view */
}
html body footer div section.address a.phone_mobile:hover {
  opacity: .7;
}
html body footer div section.address a.phone_not_mobile {
  /* This is the style that hides the non-clickable tablet/desktop version of      the phone number */
  display: none;
}
html body footer div section.social ul li {
  display: inline;
}
html body footer div section.social ul li a {
  padding: 0 1.2%;
}
html body footer div section.social ul li a:hover {
  opacity: .9;
}
/*===============================
==== 700PX CSS CODE AND UP =======
===============================*/
@media (min-width: 700px) {
  /*
* Classes
*/
  .hide_in_mobile {
    display: block;
  }
  .show_in_mobile {
    display: none;
  }
  .large_h2 {
    font-size: 4rem;
  }
  html body {
    /*-------- 700PX HEADER STYLE------*/
    /*-------- 700PX NAV STYLE------*/
    /*-------- 700PX MAIN STYLE------*/
    /*-------- 700PX FOOTER STYLE------*/
  }
  html body header label.menu-icon {
    transform: translateY(30%);
  }
  html body header h1 {
    padding-left: 1%;
    font-size: 1.7rem;
  }
  html body header h1#wrap_pas {
    display: none;
  }
  html body header h1#no_wrap_pas {
    display: block;
  }
  html body header ul.header_links {
    transform: translateY(50%);
  }
  html body main {
    border-top: 1px solid #ff9040;
  }
  html body main section {
    /*****************************
                     * Style for subcategories.php
                     *****************************/
    /*****************************
                     * Style for product_groups.php
                     *****************************/
    /*****************************
                     * Style for product_items.php
                     *****************************/
    /*****************************
                     * Style for shopping_cart.php
                     *****************************/
    /*****************************
                    * Style for about.php
                    *****************************/
  }
  html body main section.sub_intro {
    margin: 0 auto 25px auto;
    width: 60%;
  }
  html body main section.sub_cats {
    margin-top: 7px;
  }
  html body main section.sub_cats div.six.columns {
    width: 100%;
  }
  html body main section.sub_cats div.six.columns ul li {
    border-radius: 5px;
    margin-bottom: 20px;
  }
  html body main section.sub_cats div.six.columns ul li a {
    margin: 0 auto;
    font-size: 1.9rem;
  }
  html body main section.lg_image.six.columns {
    height: 431px;
    /* This will adjust the height of the paint palette image */
    border-radius: 5px;
    margin: 7px 2% 20px 2%;
    width: 46%;
  }
  html body main section#product_groups div.group_row {
    border-bottom: 1px solid #dddddd;
    display: flex;
    border: none;
    justify-content: center;
  }
  html body main section#product_groups div.group_row:first-child {
    margin-top: 20px;
  }
  html body main section#product_groups div.group_row div.product_group {
    border: 1px solid #dddddd;
    border-radius: 5px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin: 0 0 10px 10px;
  }
  html body main section#product_groups div.group_row div.product_group:first-child {
    margin-left: 0;
  }
  html body main section#product_groups div.group_row div.product_group a.group_description_text {
    align-self: flex-start;
  }
  html body main section#product_groups div.group_row div.product_group a img {
    align-self: center;
  }
  html body main section#item_wrapper p#group_info {
    display: block;
    width: 80%;
    margin: 0 auto;
  }
  html body main section#item_wrapper div#image_wrapper {
    width: 25%;
  }
  html body main section#item_wrapper div#details_wrapper {
    width: 100%;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details div#item_options {
    margin-top: 20px;
    height: 328px;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#color_thumbnails_wrapper {
    margin-left: 0;
    height: 100%;
    position: relative;
    width: 25%;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#color_thumbnails_wrapper div#color_thumbnails {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#image_wrapper {
    margin-left: 0;
    height: 100%;
    position: relative;
    width: 33%;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#image_wrapper img {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    margin: 0;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#right_col_wrapper {
    width: 20%;
    height: 100%;
    position: relative;
    margin: 0;
    width: 37%;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#right_col_wrapper div#item_options_right_col {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    margin: 0;
  }
  html body main section#cart_items div.cart_item {
    flex-wrap: nowrap;
    position: relative;
  }
  html body main section#cart_items div.cart_item img {
    width: 22%;
  }
  html body main section#cart_items div.cart_item div.cart_item_info {
    width: 100%;
    margin-left: 0;
  }
  html body main section#cart_items div.cart_item div.cart_item_info p,
  html body main section#cart_items div.cart_item div.cart_item_info input {
    font-size: 1rem;
  }
  html body main section#cart_items div.cart_item div.cart_item_info div.cart_item_specs {
    margin: 0;
  }
  html body main section#cart_items div.cart_item div.cart_item_info div.cart_item_specs p:first-child {
    margin-top: 0;
    margin-bottom: 20px;
  }
  html body main section#cart_items div.cart_item div.cart_item_info div.quantity_and_subtotal {
    width: 56%;
    display: flex;
    margin: 0;
  }
  html body main section#cart_items div.cart_item div.cart_item_info div.quantity_and_subtotal p.subtotal {
    margin: 0;
    width: 51%;
  }
  html body main section#cart_items div.cart_item div.cart_item_info p.price_display {
    margin: 0;
  }
  html body main section#cart_items div.cart_item input.remove_button {
    padding: 2px;
    position: absolute;
    right: 10px;
    bottom: 0px;
  }
  html body main section#cart_items p#total_display {
    margin: 20px 0;
    font-size: 1.2rem;
  }
  html body main section#about div#about_images {
    padding-right: 2%;
  }
  html body footer {
    height: 140px;
  }
  html body footer div {
    height: 100%;
    padding: 0;
  }
  html body footer div section.hours {
    padding: 0;
    height: 100%;
    position: relative;
  }
  html body footer div section.hours ul {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
  html body footer div section.address {
    height: 100%;
    letter-spacing: .04rem;
    position: relative;
    margin-top: 0;
  }
  html body footer div section.address ul {
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
  html body footer div section.address ul a.phone_mobile {
    /* This hides the mobile version of the phone number */
    display: none;
  }
  html body footer div section.address ul a.phone_not_mobile {
    /* This displays the tablet/desktop version of the phone number */
    display: block;
  }
  html body footer div section.social {
    height: 100%;
    position: relative;
    margin-top: 0;
  }
  html body footer div section.social ul {
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%, -50%);
    width: 100%;
    margin: 0;
  }
  html body footer div section.social ul li {
    margin: 0 auto;
  }
  html body footer div section.social ul li a {
    padding: 0 .5%;
    display: inline-block;
  }
}
/*===============================
=== 900PX CSS CODE AND UP =======
===============================*/
@media (min-width: 900px) {
  html body {
    /*-------- 900PX HEADER STYLE ------*/
    /*-------- 900PX MAIN STYLE ------*/
    /*-------- 900PX FOOTER STYLE ------*/
  }
  html body header {
    /*-------- 900PX NAV STYLE------*/
  }
  html body header nav ul {
    margin: 2px 0;
    width: 100%;
  }
  html body header nav ul li {
    margin-left: 2px;
    /* This spaces out the navigation buttons evenly */
    width: 12%;
  }
  html body header nav ul li a {
    /* This style adjusts the width of the navigation buttons */
    padding: 5px 10%;
  }
  html body main section {
    /*****************************
                     * Style for product_items.php
                     *****************************/
    /*****************************
                     * Style for shopping_cart.php
                     *****************************/
  }
}
/*===============================
=== 1000PX CSS CODE AND UP =======
===============================*/
@media (min-width: 1000px) {
  html body {
    /*-------- 1000PX HEADER STYLE ------*/
    /*-------- 1000PX NAV STYLE------*/
    /*-------- 1000PX MAIN STYLE ------*/
    /*-------- 1000PX FOOTER STYLE ------*/
  }
  html body main h2#mobile_version {
    display: none;
  }
  html body main section {
    /*****************************
                     * Style for product_items.php
                     *****************************/
  }
  html body main section#item_wrapper {
    height: 650px;
    padding: 15px;
  }
  html body main section#item_wrapper h2#non_mobile_version {
    font-size: 2rem;
    display: block;
  }
  html body main section#item_wrapper div#image_wrapper {
    width: 42%;
    height: 100%;
    position: relative;
    box-shadow: 5px 5px 20px #AAA;
    margin: 0;
  }
  html body main section#item_wrapper div#image_wrapper img#product_item_image {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
  }
  html body main section#item_wrapper div#details_wrapper {
    height: 100%;
    width: 56.67%;
    position: relative;
    box-shadow: 5px 5px 20px #AAA;
    margin: 0 0 0 10px;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details {
    overflow: hidden;
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    margin: auto;
    height: min-content;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details p#group_info {
    margin: 0 auto 40px auto;
    width: 80%;
    display: block;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details div#item_options {
    height: 350px;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#color_thumbnails_wrapper {
    width: 50%;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#color_thumbnails_wrapper div#color_thumbnails {
    margin-left: 2%;
  }
  html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#right_col_wrapper {
    margin: 0;
    overflow: hidden;
    width: 50%;
  }
}
