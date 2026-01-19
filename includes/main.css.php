/*
<?php

header('Content-Type: text/css');
?>
*/
/* Link to color palette:

https://paletton.com/#uid=60f0u0kuauvivBun-vxvonRAQiM

*/
/* MIXINS */
/* COLOR PALETTE */
@property --secondary-color1 {
  syntax: '<color>';
  initial-value: #D90D4B;
  inherits: false;
}
@property --secondary-color2 {
  syntax: '<color>';
  initial-value: #F3910E;
  inherits: false;
}
/* @color1: #0E24CC;
@color2: #3D4899;
@color3: #00A4FF;
@color4: #FF9040;
@color5: #CC4714; */
.clearfloat {
  clear: both;
}
.price_display {
  color: #0AA764;
}
.required {
  color: #c43f0a;
}
.card {
  background-color: white;
  border-radius: 10px;
  box-shadow: 5px 5px 20px #AAA;
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
  background-color: #F2F2F2;
  color: #333333;
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
  letter-spacing: 0.07rem;
  position: relative;
  /*--------NAV STYLE------*/
}
html body header h1 {
  padding: 20px 0 20px 3%;
  font-family: 'Arvo', serif;
  /* This is a Google Font */
  color: white;
  font-size: 1rem;
  background: linear-gradient(10deg, #F34F0E, #F34F0E 19vw, #D90D4B 19vw, #D90D4B);
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
  top: -6px;
  right: 20px;
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
html body header ul.header_links li a.shopping_cart_icon img {
  width: 38px;
}
html body header ul.header_links li a.shopping_cart_icon p#cart_count_display {
  position: absolute;
  top: 26%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 0.8rem;
  font-weight: bolder;
  color: #333333;
  font-weight: 900;
}
html body header ul.header_links li a#username_display {
  font-size: 0.8rem;
  margin-bottom: 3px;
  display: block;
  font-weight: 900;
  color: #333;
}
html body header ul.header_links li a#login_link {
  margin-right: 10px;
  font-size: 1rem;
  margin: 0;
}
html body header ul.header_links li a#login_link img {
  width: 38px;
}
html body header nav ul {
  width: 94%;
  margin: 0 auto;
  background-color: #F2F2F2;
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
  opacity: 0.8;
}
html body header nav ul li a:visited {
  color: #333333;
}
html body main {
  text-align: center;
  min-height: calc(100vh - 207.2px);
  background-color: #fafafa;
  border-top: 1px dotted #F34F0E;
  /* The style below hides the dotted border when the navigation menu is collapsed */
  margin-top: -1px;
  letter-spacing: 0.1rem;
  overflow: hidden;
}
html body main#home {
  background: linear-gradient(355deg, #F3910E, #F3910E 21vh, #D90D4B 192vh, #D90D4B);
  min-height: 200vh;
}
html body main#home h2 {
  position: relative;
  top: -59vh;
  left: 3vh;
  font-size: 2.8em;
  font-weight: 900;
  text-align: left;
}
html body main#home img {
  transform: scaleX(-1);
}
html body main#home div.image_overlay {
  position: relative;
  top: -8vh;
  height: 57vh;
  background-color: #F3910E;
  transform: rotate(10deg);
  width: 150vw;
  left: -9vh;
}
html body main#home div.image_overlay:first-child {
  display: none;
}
html body main h2 {
  font-size: 2rem;
  margin: 20px auto;
  color: #B83906;
  font-weight: bold;
  clear: both;
  max-width: 97%;
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
  color: #B83906;
  box-shadow: 2px 2px 12px #444;
}
html body main section#product_groups {
  display: grid;
  gap: 20px;
  margin: 40px 20px 20px 20px;
  max-width: 1600px;
}
html body main section#product_groups div.product_group {
  padding: 20px 0 0 0;
}
html body main section#product_groups div.product_group a.group_description_text {
  max-width: 97%;
  margin: 0 auto;
  text-decoration: none;
  font-size: 1.2rem;
  display: block;
  padding: 0 0 5px 0;
  color: #333333;
}
html body main section#product_groups div.product_group a.group_description_text:visited {
  color: #333333;
}
html body main section#product_groups div.product_group a img {
  border-radius: 10px;
}
html body main section#item_wrapper {
  display: grid;
  margin: 40px 20px 20px 20px;
  gap: 20px;
  max-width: 1100px;
}
html body main section#item_wrapper div#image_wrapper img {
  border-radius: 10px;
}
html body main section#item_wrapper div#details_wrapper {
  text-align: initial;
  letter-spacing: initial;
  padding: 20px;
  align-content: center;
}
html body main section#item_wrapper div#details_wrapper div#item_details p#group_info {
  max-width: 97%;
  margin: 20px auto;
  display: none;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options {
  display: grid;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#color_thumbnails_wrapper div#color_thumbnails {
  display: grid;
  grid-template-columns: repeat(auto-fill, 40px);
  grid-auto-rows: 40px;
  justify-content: center;
  gap: 6px;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#color_thumbnails_wrapper div#color_thumbnails img {
  border: 1px solid black;
  border-radius: 3px;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#drop_down_wrapper {
  margin: 20px 0;
  text-align: center;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#drop_down_wrapper p#price {
  color: #333333;
  margin: 20px 0;
  font-size: 1.3rem;
  letter-spacing: 1px;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#drop_down_wrapper p#price span.price_display {
  font-size: 1.9rem;
  font-weight: 600;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#drop_down_wrapper div#drop_down_options div {
  display: flex;
  gap: 15px;
  margin: 15px 0;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#drop_down_wrapper div#drop_down_options div label {
  margin-right: 5px;
  color: #333333;
  font-size: 1.1em;
  letter-spacing: 1px;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#drop_down_wrapper div#drop_down_options div select {
  padding: 10px 16px;
  font-size: 1.1em;
  border: 3px solid #333333;
  color: #333333;
  background-color: white;
  letter-spacing: 1px;
  padding: 10px 0 10px 16px;
  border-radius: 11px;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#drop_down_wrapper div#drop_down_options div#color {
  white-space: nowrap;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#drop_down_wrapper div#drop_down_options div#size select {
  padding-right: 20px;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#drop_down_wrapper div#drop_down_options input#reset_button {
  padding: 10px 16px;
  font-size: 1.1em;
  border: 3px solid #333333;
  color: #333333;
  background-color: white;
  letter-spacing: 1px;
  border-radius: 20px;
  transition: transform 0.3s;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#drop_down_wrapper div#drop_down_options input#reset_button:hover {
  cursor: pointer;
  transform: scale(1.1);
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#drop_down_wrapper input#add_to_cart {
  padding: 14px 20px;
  font-size: 1.3em;
  color: #0AA764;
  border: 3px solid #0AA764;
  border-radius: 50px;
  background-color: white;
  font-weight: 900;
  letter-spacing: 1px;
  margin: 20px 0 0 0;
  transition: transform 0.3s;
}
html body main section#item_wrapper div#details_wrapper div#item_details div#item_options div#drop_down_wrapper input#add_to_cart:hover {
  cursor: pointer;
  transform: scale(1.1);
}
html body main section.products {
  margin: 0 auto;
}
html body main section#cart_items p#empty_cart_message {
  margin-bottom: 325px;
}
html body main section#cart_items div.cart_item {
  overflow: hidden;
  margin: 15px auto;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  font-size: 0.8rem;
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
  font-size: 0.8rem;
}
html body footer div {
  width: 100%;
  margin: 0 auto;
  padding: 5px 0;
  background-color: rgba(34, 34, 34, 0.9);
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
  letter-spacing: 0.06rem;
  margin-top: 0;
}
html body footer div section.hours li:nth-child(odd) {
  /* This style applies to every other list item */
  margin-top: 10px;
}
html body footer div section.address {
  letter-spacing: 0.04rem;
}
html body footer div section.address a {
  text-decoration: none;
  color: white;
}
html body footer div section.address a.phone_mobile {
  /* This is the style for the tappable phone link in mobile view */
}
html body footer div section.address a.phone_mobile:hover {
  opacity: 0.7;
}
html body footer div section.address a.phone_not_mobile {
  /* This is the style that hides the non-clickable tablet/desktop version of      the phone number */
  display: none;
}
html body footer div section.social {
  margin-top: 20px;
}
html body footer div section.social ul li {
  display: inline;
}
html body footer div section.social ul li a {
  padding: 7.5px;
  border-radius: 10px;
  line-height: 0;
  display: inline-block;
  margin: 0 1.2%;
}
html body footer div section.social ul li a#x {
  background-color: black;
}
html body footer div section.social ul li a#facebook,
html body footer div section.social ul li a#instagram,
html body footer div section.social ul li a#pinterest {
  background-color: white;
}
html body footer div section.social ul li a img {
  width: 30px;
}
/*===============================
=== 440PX CSS CODE AND UP =======
===============================*/
@media (min-width: 440px) {
  html body {
    /*-------- 440PX HEADER STYLE ------*/
    /*-------- 440PX NAV STYLE------*/
    /*-------- 440PX MAIN STYLE ------*/
    /*-------- 440PX FOOTER STYLE ------*/
  }
  html body main#home h2 {
    top: -63vh;
    left: 4vw;
    font-size: 3.5em;
  }
  html body main#home div.image_overlay {
    top: -10vh;
  }
  html body main section {
    /*****************************
                     * Style for product_items.php
                     *****************************/
  }
}
/*===============================
=== 550PX CSS CODE AND UP =======
===============================*/
@media (min-width: 550px) {
  /*****************************
    * Style for product_groups.php
    *****************************/
  section#product_groups {
    grid-template-columns: repeat(2, 1fr);
  }
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
    background: linear-gradient(10deg, #F34F0E, #F34F0E 10vw, #D90D4B 10vw, #D90D4B);
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
    border-top: 1px solid #F34F0E;
    position: relative;
  }
  html body main#home h2 {
    top: -68vh;
    font-size: 4.6em;
  }
  html body main#home div.image_overlay:first-child {
    display: block;
    top: -56vh;
    position: absolute;
    z-index: 2;
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
  html body main section#product_groups div.product_group {
    border: 1px solid #DDD;
  }
  html body main section#product_groups div.product_group a.group_description_text {
    align-self: flex-start;
  }
  html body main section#product_groups div.product_group a img {
    align-self: center;
  }
  html body main section#item_wrapper {
    grid-template-columns: 1fr 1fr;
  }
  html body main section#item_wrapper p#group_info {
    display: block;
    width: 80%;
    margin: 0 auto 40px;
    grid-column: 1 / -1;
  }
  html body main section#item_wrapper div#image_wrapper {
    align-content: center;
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
    letter-spacing: 0.04rem;
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
    display: inline-block;
  }
}
/*===============================
=== 800PX CSS CODE AND UP =======
===============================*/
@media (min-width: 800px) {
  /*****************************
    * Style for product_groups.php
    *****************************/
  section#product_groups {
    grid-template-columns: repeat(3, 1fr);
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
  html body main {
    min-height: calc(100vh - 251.2px);
  }
  html body main#home div.image_overlay:first-child {
    top: -60vh;
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
  html body main {
    text-align: center;
    min-height: calc(100vh - 207.2px);
    background-color: #fafafa;
    border-top: 1px solid #F34F0E;
    /* The style below hides the border when the navigation menu is collapsed */
    margin-top: -1px;
    letter-spacing: 0.1rem;
    overflow: hidden;
  }
  html body main#home h2 {
    top: -80vh;
    font-size: 5em;
  }
  html body main#home div.image_overlay {
    top: -22vh;
  }
  html body main section {
    /*****************************
                     * Style for product_groups.php
                     *****************************/
    /*****************************
                     * Style for product_items.php
                     *****************************/
  }
  html body main section#product_groups {
    grid-template-columns: repeat(4, 1fr);
  }
}
/*===============================
=== 1100PX CSS CODE AND UP =======
===============================*/
@media (min-width: 1140px) {
  html body main section#item_wrapper {
    margin: 20px auto;
  }
}
/*===============================
=== 1500PX CSS CODE AND UP =======
===============================*/
@media (min-width: 1500px) {
  html body {
    /*-------- 1500PX HEADER STYLE ------*/
    /*-------- 1500PX NAV STYLE------*/
    /*-------- 1500PX MAIN STYLE ------*/
    /*-------- 1500PX FOOTER STYLE ------*/
  }
  html body main#home h2 {
    font-size: 7em;
    top: -88vh;
  }
  html body main section {
    /*****************************
                     * Style for product_items.php
                     *****************************/
  }
}
/*===============================
=== 1600PX CSS CODE AND UP =======
===============================*/
@media (min-width: 1600px) {
  html body main section#product_groups {
    margin: 20px auto;
  }
}
