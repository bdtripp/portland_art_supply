/*
<?php

header('Content-Type: text/css');
?>
*/

/* Link to color palette:

https://paletton.com/#uid=60f0u0kuauvivBun-vxvonRAQiM

*/

/* MIXINS */

.set_background(@bg_image, @bg_size: cover, @bg_position: left top, @bg_height: auto) {
    background-image: @bg_image;
    background-size: @bg_size;
    background-position: @bg_position;
    height: @bg_height;
}

.linear_gradient1() {
    background: linear-gradient(
        355deg,
        @secondary-color2,
        @secondary-color2 21vh,
        @secondary-color1 192vh,
        @secondary-color1
    );
}

.CTA() {
  padding: 14px 20px;
  font-size: 1.3em;
  color: @complementary-color1;
  border: 3px solid #0AA764;
  border-radius: 50px;
  background-color: white;
  font-weight: 900;
  letter-spacing: 1px;
  margin: 20px 0 0 0;
}

.input_style() {
    padding: 10px 16px;
    font-size: 1.1em;
    border: 3px solid @dark-gray;
    color: @dark-gray;
    background-color: white;
    letter-spacing: 1px;
    border-radius: 10px;
}

.hover1() {
    transition: transform .3s;

    &:hover {
        cursor: pointer;
        transform: scale(1.1);
    }
}

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

@primary-color1: #F34F0E;
@secondary-color1: #D90D4B;
@secondary-color2: #F3910E;
@secondary-color3: #B83906;
@complementary-color1: #0AA764;

@dark-gray: #333333;
@off-white: #F2F2F2;
@lightGrayBorder: #DDD;

/* @color1: #0E24CC;
@color2: #3D4899;
@color3: #00A4FF;
@color4: #FF9040;
@color5: #CC4714; */

button {
    font-family: 'Open Sans', sans-serif;
}

.clearfloat {
    clear: both;
}

.price_display {
    color: @complementary-color1;
}

.required {
    color: darken(@primary-color1, 10%);;
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

    body {
        font-family: 'Open Sans', sans-serif;
        overflow: auto;
        background-color: @off-white;
        color: @dark-gray;

        img {
            max-width: 100%;
            height: auto;
            vertical-align: middle;
        }

/*--------HEADER STYLE------*/

        header {
            font-size: 1.2rem;
            letter-spacing: .07rem;
            position: relative;

            h1 {
                padding: 20px 0 20px 3%;
                font-family: 'Arvo', serif; /* This is a Google Font */
                color: white;
                font-size: 1rem;
                background: linear-gradient(
                    70deg, 
                    darken(@primary-color1, 5%) ,
                    darken(@primary-color1, 5%) 36vw,  
                    lighten(@primary-color1, 20%) 62vw,
                    lighten(@primary-color1, 20%)
                );

                &#no_wrap_pas {
                    display: none;
                }
            }

            label {

                &.menu-icon {
                    transform: translateY(35%);
                    padding: 20px 15px;
                }
            }

            ul {

                &.header_links {
                    float: right;
                    position: absolute;
                    top: -6px;
                    right: 20px;
                    transform: translateY(70%);

                    li {
                        display: inline-block;
                        vertical-align: middle;

                        a {
                            padding: 0;
                            text-decoration: none;
                            color: black;

                            &.shopping_cart_icon {
                                position: relative;
                                display: flex;

                                img {
                                    width: 38px;
                                }

                                p {

                                    &#cart_count_display {
                                        position: absolute;
                                        top: 20%;
                                        left: 49%;
                                        transform: translate(-50%, -50%);
                                        font-size: .8rem;
                                        font-weight: bolder;
                                        color: @dark-gray;
                                        font-weight: 900;
                                    }
                                }
                            }

                            &#username_display {
                                font-size: .8rem;
                                margin-bottom: 3px;
                                display: block;
                                font-weight: 900;
                                color: #333;
                            }

                            &#login_link {
                                margin-right: 10px;
                                font-size: 1rem;
                                margin: 0;

                                img {
                                    width: 38px;
                                }
                        }
                    }
                }
            }
        }


            /*--------NAV STYLE------*/

            nav {

                ul {
                    width: 94%;
                    margin: 0 auto;
                    background-color: @off-white;
                    display: flex;
                    flex-direction: column;
                    overflow: hidden;

                    & > li {
                        font-weight: 700;
                    }

                    li {
                        text-align: center;
                        border-radius: 5px;

                        &:hover {
                            background-color: #EEE;
                        }

                        &[aria-current="page"], &:has([aria-current="page"]) {
                            /* This style identifies the page or Category and Subcategory the user is currently on */
                            background-color: #DDD;
                        }

                        a {
                            text-decoration: none;
                            color: @dark-gray;

                            &[aria-current="page"] {
                                /* This style identifies the page or Category and Subcategory the user is currently on */
                                background-color: #DDD;
                            }

                            &:hover {
                                opacity: .8;
                            }

                            &:visited {
                                color: @dark-gray;
                            }
                        }

                        button {
                            font-size: 1.5rem;
                            padding: 15px 0;
                            border: none;
                            background-color: inherit;
                            color: inherit;
                            letter-spacing: inherit;
                            width: 100%;
                            display: flex;
                            border-radius: inherit;
                            font-weight: inherit;

                            &::before {
                                content: "";
                                flex: 1;
                                text-align: left;
                                padding-left: 3px;
                            }

                            &[aria-expanded="true"] {
                                border: 2px solid white;
                                border-bottom: none;
                                border-radius: 5px 5px 0 0;

                                span {
                                    transform: scaleY(-1);
                                    transition: transform .3s;
                                }
                            }
                        }

                        span {
                            flex: 1;
                            text-align: right;
                            padding-right: 3px;
                        }

                        // Drop down menu conent

                        ul {
                            max-height: 0;
                            transition: none;
                            border-top-left-radius: 0;
                            border-top-right-radius: 0;
                            border-bottom-left-radius: inherit;
                            border-bottom-right-radius: inherit;
                            width: 100%;

                            li {
                                border-radius: 5px;
                                font-weight: initial;
                                margin: 0 2px;
                                padding-left: 10px;
                                padding-right: 10px;

                                a {
                                    display: inline-block;
                                    width: 100%;
                                }
                            }
                        }

                        // The expanded drop down menu if any

                        button[aria-expanded="true"] + ul {
                            max-height: 500px;
                            transition: max-height 1s;
                            background-color: white;
                            padding-bottom: 2px;
                        }
                    }

                    // Home and About <li>s

                    li:not(:has(button)) {
                        font-size: 1.5rem;
                        padding: 15px 0;
                        margin: 1px 0;
                    }
                }
            }
        }



        /*--------MAIN STYLE------*/

        main {
            text-align: center;
            min-height: calc(100vh - 207.2px);
            background-color: lighten(@off-white, 3%);
            border-top: 1px dotted @primary-color1;
            /* The style below hides the dotted border when the navigation menu is collapsed */
            margin-top: -1px;
            letter-spacing: .1rem;
            overflow: hidden;

            &#home {
                .linear_gradient1();
                min-height: 200vh;

                h2 {
                    position: relative;
                    top: -59vh;
                    left: 3vh;
                    font-size: 2.8em;
                    font-weight: 900;
                    text-align: left;
                    color: darken(@secondary-color3, 5%);
                }

                img {
                    transform: scaleX(-1);
                }

                div {
                    &.image_overlay {
                        position: relative;
                        top: -8vh;
                        height: 57vh;
                        background-color: lighten(@primary-color1, 20%);
                        transform: rotate(10deg);
                        width: 150vw;
                        left: -9vh;

                        &:first-child {
                            display: none;
                        }
                    }
                }

            }

            h2 {
                font-size: 3rem;
                margin: 20px auto;
                padding: 0 20px;
                color: @secondary-color3;
                font-weight: bold;
                clear: both;
                max-width: 97%;
            }

            section {

                input {
                    padding: 5px 3px;
                }

                /*****************************
                * Style for subcategories.php
                *****************************/

                &.sub_intro {
                    margin: 20px auto 15px auto;
                    line-height: 130%;
                    width: 95%;
                    text-align: center;
                    font-size: 1.1rem;

                }

                &.lg_image {
                    /* The image used here is 1200 x 799 pixels */
                    .set_background(url(../images/paint2.jpg), cover, center, 350px)
                }

                ul {

                    li {

                        a {
                            text-decoration: none;
                            font-size: 1.5rem;
                            display: block;
                            margin: 7px auto;
                            padding: 3px;
                            border-radius: 3px;
                            color: @secondary-color3;
                            box-shadow: 2px 2px 12px #444;
                        }
                    }
                }

                /*****************************
                 * Style for product_groups.php
                 *****************************/

                &#product_groups {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(250px, 400px));
                    justify-content: center;
                    gap: 20px;
                    margin: 40px 20px 20px 20px;
                    max-width: 1600px;

                    div {

                        &.product_group {
                            padding: 20px 0 0 0;

                            a {

                                &.group_description_text {
                                    max-width: 97%;
                                    margin: 0 auto;
                                    text-decoration: none;
                                    font-size: 1.2rem;
                                    display: block;
                                    padding: 0 0 5px 0;
                                    color: @dark-gray;

                                    &:visited {
                                        color: @dark-gray;
                                    }
                                }

                                img {
                                    border-radius: 10px;
                                }
                            }
                        }
                    }
                }

                /*****************************
                * Style for product_items.php
                *****************************/

                &#item_wrapper {
                    display: grid;
                    margin: 40px 20px 20px 20px;
                    gap: 20px;
                    max-width: 1100px;

                    h2 {

                    }

                    div {

                        &#image_wrapper {
                            
                            img {
                                border-radius: 10px;

                                &#product_item_image {

                                }
                            }
                        }

                        &#details_wrapper {
                            text-align: initial;
                            letter-spacing: initial;
                            padding: 20px;
                            align-content: center;

                            div {

                                &#item_details {

                                    p {

                                        &#group_info {
                                            max-width: 97%;
                                            margin: 20px auto;
                                            display: none;
                                        }
                                    }

                                    div {

                                        &#item_options {
                                            display: grid;

                                            div {

                                                &#color_thumbnails_wrapper {

                                                    div {

                                                        &#color_thumbnails {
                                                            display: grid;
                                                            grid-template-columns: repeat(auto-fill, 40px);
                                                            grid-auto-rows: 40px;
                                                            justify-content: center;
                                                            gap: 6px;

                                                            img {
                                                                border: 1px solid black;
                                                                border-radius: 3px;
                                                            }
                                                        }
                                                    }
                                                }

                                                &#drop_down_wrapper {
                                                    margin: 20px 0;
                                                    text-align: center; 
                                                            
                                                    p {

                                                        &#price {
                                                            color: @dark-gray;
                                                            margin: 20px 0;
                                                            font-size: 1.3rem;
                                                            letter-spacing: 1px;

                                                            span {

                                                                &.price_display {
                                                                    font-size: 1.9rem;
                                                                    font-weight: 600;
                                                                }
                                                            }
                                                        }
                                                    }

                                                    div {

                                                        &#drop_down_options {

                                                            
                                                            div {
                                                                display: flex;
                                                                gap:15px;
                                                                margin: 15px 0;
                                                                justify-content: center;
                                                                align-items: center;
                                                                flex-wrap: wrap;

                                                                label {
                                                                    margin-right: 5px;
                                                                    color: @dark-gray;
                                                                    font-size: 1.1em;
                                                                    letter-spacing: 1px;
                                                                    
                                                                }

                                                                select {
                                                                    .input_style();
                                                                    padding: 10px 0 10px 16px;
                                                                    border-radius: 11px;
                                                                }

                                                                &#color {
                                                                    white-space: nowrap;
                                                                }

                                                                &#size {

                                                                    select {
                                                                        padding-right: 20px;
                                                                    }
                                                                }

                                                                &#quantity {

                                                                }
                                                            }

                                                            input#reset_button {
                                                                .input_style();
                                                                border-radius: 20px;
                                                                .hover1();
                                                            }
                                                        }
                                                    }

                                                    input#add_to_cart {
                                                        .CTA();
                                                        .hover1();
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                &.products {
                    margin: 0 auto;
                }

                /*****************************
                * Style for shopping_cart.php
                *****************************/

                &#cart_items {

                    
                    p {
                        
                        &#empty_cart_message {
                            margin-bottom: 325px;
                        }
                    }

                    div {

                        &#cart_items_wrapper {
                            display: grid;
                            grid-template-columns: repeat(auto-fit, minmax(250px, 400px));
                            justify-content: center;
                            margin: 40px 20px 20px 20px;
                            gap: 20px;
                            max-width: 2000px;

                            div {

                                &.cart_item {
                                    display: flex;
                                    flex-direction: column;
                                    justify-content: flex-end;
                                    align-items: center;
                                    flex-wrap: wrap;

                                    img {
                                        border-radius: 10px;
                                    }

                                    div {

                                        &.cart_item_info {
                                            display: flex;
                                            flex-direction: column;
                                            gap: 20px;
                                            padding: 10px 20px;
                                            font-size: 1.2rem;

                                            div {

                                                &.cart_item_specs {

                                                    p:first-child {

                                                    }

                                                }

                                                &.quantity {

                                                    label {
                                                    }

                                                    select {
                                                        .input_style();
                                                        padding: 7px 16px;
                                                    }
                                                }
                                            }

                                            p {

                                                &.price_display {

                                                }
                                            }
                                        }
                                    }

                                    input {

                                        &.remove_button {
                                            .input_style();
                                            .hover1();
                                            margin: 20px 0 20px 0;
                                            justify-self: flex-end;
                                        }
                                    }
                                }
                            }
                        }
                    }

                    p {

                        &#total_display {
                            margin: 50px 0 20px 0;
                            font-size: 1.5rem;
                        }
                    }

                    input {

                        &#checkout_button {
                            .CTA();
                            .hover1();
                            margin-bottom: 40px;
                        }
                    }
                }

                /*****************************
                * Style for about.php
                *****************************/

                &#about {
                    margin-bottom: 50px;
                    overflow: auto;

                    div {

                        &#about_text {
                            text-align: left;
                            margin-bottom: 40px;

                            p {
                                width: 90%;
                                margin: 0 auto;
                            }
                        }
                    }

                    div {

                        &#about_images {

                            img {
                                margin-bottom: 20px;
                            }
                        }
                    }
                }
            }
        }

        /*--------FOOTER STYLE------*/

        footer {
            /* The image used here is 1366 x 911 pixels */
            .set_background(url(../images/paint.jpg), cover, center, auto);
            color: white;
            font-weight: bold;
            font-size: .8rem;

            div {
                width: 100%;
                margin: 0 auto;
                padding: 5px 0;
                background-color: rgba(34, 34, 34, .9);

                section {
                    margin-top: 15px;
                    text-align: center;

                    &.hours, &.address {

                        ul {

                            li {
                                margin: 5px 0;
                            }
                        }
                    }

                    &.hours {
                        padding: 10px 0;
                        letter-spacing: .06rem;
                        margin-top: 0;

                        li:nth-child(odd) {         /* This style applies to every other list item */
                            margin-top: 10px;
                        }
                    }

                    &.address {
                        letter-spacing: .04rem;

                        a {
                            text-decoration: none;
                            color: white;

                            &.phone_mobile {
                                /* This is the style for the tappable phone link in mobile view */
                                    &:hover {
                                    opacity: .7;
                                }
                            }

                            &.phone_not_mobile {
                                /* This is the style that hides the non-clickable tablet/desktop version of      the phone number */
                                display: none;
                            }
                        }
                    }

                    &.social {
                        margin-top: 20px;

                        ul {

                            li {
                                display: inline;

                                a {
                                    padding: 7.5px;
                                    border-radius: 10px;
                                    line-height: 0;
                                    display: inline-block;
                                    margin: 0 1.2%;

                                    &#x {
                                        background-color: black;
                                    }

                                    &#facebook, &#instagram, &#pinterest {
                                        background-color: white;
                                    }

                                    img {
                                        width: 30px;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

/*===============================
=== 440PX CSS CODE AND UP =======
===============================*/

@media (min-width: 440px) {

    html {

        body {

            /*-------- 440PX HEADER STYLE ------*/

            header {

                h1 {

                    &#wrap_pas {

                    }

                    &#no_wrap_pas {

                    }
                }

                ul {

                    &.header_links {

                        li {

                            a {

                            }
                        }
                    }
                }
            }

            /*-------- 440PX NAV STYLE------*/

            nav {

                ul{

                    li {

                        a {

                        }
                    }
                }
            }

            /*-------- 440PX MAIN STYLE ------*/

           main {

                &#home {

                    h2 {
                        top: -63vh;
                        left: 4vw;
                        font-size: 3.5em;
                    }

                    img {

                    }

                    div {
                        &.image_overlay {
                            top: -10vh;
                        }
                    }
                }

                h2 {

                }

                section {

                    /*****************************
                     * Style for product_items.php
                     *****************************/

                    &#item_wrapper {
                        
                        h2 {

                        }

                        div {

                            &#image_wrapper {

                                img {

                                    &#product_item_image {

                                    }
                                }
                            }

                            &#details_wrapper {

                                div {

                                    &#item_details {


                                        p {
                                            &#group_info {

                                            }
                                        }

                                        div {

                                            &#item_options {

                                                div {

                                                    &#color_thumbnails_wrapper {


                                                        div {
                                                            &#color_thumbnails {

                                                            }
                                                        }
                                                    }


                                                    &#image_wrapper {
                                                        
                                                        img {

                                                        }
                                                    }

                                                    &#drop_down_wrapper {

                                                        div {

                                                            &#item_options_right_col {

                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            /*-------- 440PX FOOTER STYLE ------*/

            footer {

            }
        }
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

    html {

        body {

            /*-------- 700PX HEADER STYLE------*/

            header {

                label {
                    &.menu-icon {
                        transform: translateY(30%);
                    }
                }

                h1 {
                padding-left: 1%;
                font-size: 1.7rem;
                // background: linear-gradient(
                //     10deg, 
                //     darken(@primary-color1, 5%) ,
                //     darken(@primary-color1, 5%) 13vw,  
                //     lighten(@primary-color1, 20%) 13vw,
                //     lighten(@primary-color1, 20%)
                // );

                    &#wrap_pas {
                        display: none;
                    }

                    &#no_wrap_pas {
                        display: block;
                    }
                }

                ul {

                    &.header_links {
                        transform: translateY(50%);

                        li {

                            a {

                            }
                        }
                    }
                }
            }

        /*-------- 700PX NAV STYLE------*/

            nav {

                ul{

                    li {

                        a {

                        }
                    }
                }
            }


        /*-------- 700PX MAIN STYLE------*/

            main {
                border-top: 1px solid @primary-color1;

                &#home {

                    h2 {
                        top: -68vh;
                        font-size: 4.6em;
                    }

                    img {

                    }

                    div {
                        &.image_overlay {
                            
                            &:first-child {
                                display: block;
                                top: -56vh;
                                position: absolute;
                                z-index: 2;
                            }

                        }
                    }

                }

                h2 {

                }

                section {

                    /*****************************
                     * Style for subcategories.php
                     *****************************/

                    &.sub_intro {
                        margin: 0 auto 25px auto;
                        width: 60%;
                    }

                    &.sub_cats {
                        margin-top: 7px;

                        div {

                            &.six.columns {
                                width: 100%;

                                ul{

                                    li {
                                        border-radius: 5px;
                                        margin-bottom: 20px;

                                        a {
                                            margin: 0 auto;
                                            font-size: 1.9rem;

                                        }
                                    }
                                }
                            }
                        }
                    }

                    &.lg_image.six.columns {
                        height: 431px; /* This will adjust the height of the paint palette image */
                        border-radius: 5px;
                        margin: 7px 2% 20px 2%;
                        width: 46%;
                    }

                    /*****************************
                     * Style for product_groups.php
                     *****************************/

                    &#product_groups {

                        div {

                            &.product_group {
                                border: 1px solid @lightGrayBorder;

                                a {

                                    &.group_description_text {
                                        align-self: flex-start;
                                    }

                                    img {
                                        align-self: center;
                                    }
                                }
                            }
                        }  
                    }

                    /*****************************
                     * Style for product_items.php
                     *****************************/

                    &#item_wrapper {
                        grid-template-columns: 1fr 1fr;

                        p {

                            &#group_info {
                                display: block;
                                width: 80%;
                                margin: 0 auto 40px;
                                grid-column: 1 / -1;
                            }
                        }

                        h2 {

                        }

                        div {

                            &#image_wrapper {
                                  align-content: center;

                                img {

                                    &#product_item_image {

                                    }
                                }
                            }

                            &#details_wrapper {

                                div {

                                    &#item_details {

                                        div {

                                            &#item_options {

                                                div {

                                                    &#color_thumbnails_wrapper {

                                                        div {

                                                            &#color_thumbnails {

                                                            }
                                                        }
                                                    }

                                                    &#image_wrapper {

                                                        img {

                                                        }
                                                    }

                                                    &#drop_down_wrapper {

                                                            div {

                                                                &#item_options_right_col {

                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                    /*****************************
                     * Style for shopping_cart.php
                     *****************************/

                    &#cart_items {

                        div {

                            &#cart_items_wrapper {

                                div {

                                    &.cart_item {

                                        img {

                                        }

                                        div {

                                            &.cart_item_info {

                                            }
                                        }

                                        input {

                                            &.remove_button {

                                            }
                                        }
                                    }
                                }
                            }
                        }

                        p {

                            &#total_display {

                            }
                        }

                        input {

                            &#checkout_button {

                            }
                        }
                    }

                    /*****************************
                    * Style for about.php
                    *****************************/

                    &#about {

                        div {

                            &#about_text {

                                p {

                                }
                            }
                        }

                        div {

                            &#about_images {
                                padding-right: 2%;

                                img {

                                }
                            }
                        }
                    }
                }
            }

        /*-------- 700PX FOOTER STYLE------*/

        footer {
            height: 140px;

            div {
                height: 100%;
                padding: 0;

                section {

                        &.hours {
                            padding: 0;
                            height: 100%;
                            position: relative;

                            ul {
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                            }
                        }

                        &.address {
                            height: 100%;
                            letter-spacing: .04rem;
                            position: relative;
                            margin-top: 0;

                            ul {
                                margin: 0;
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);

                                a {
                                    &.phone_mobile {
                                        /* This hides the mobile version of the phone number */
                                        display: none;
                                    }

                                    &.phone_not_mobile {
                                        /* This displays the tablet/desktop version of the phone number */
                                        display: block;
                                    }
                                }
                            }
                        }

                        &.social {
                            height: 100%;
                            position: relative;
                            margin-top: 0;

                            ul{
                                top: 50%;
                                left: 50%;
                                position: absolute;
                                transform: translate(-50%, -50%);
                                width: 100%;
                                margin: 0;

                                li {
                                    margin: 0 auto;

                                    a {
                                        display: inline-block;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}


/*===============================
=== 900PX CSS CODE AND UP =======
===============================*/

@media (min-width: 900px) {

    html {

        body {

            /*-------- 900PX HEADER STYLE ------*/

            header {

                h1 {

                    &#wrap_pas {

                    }

                    &#no_wrap_pas {

                    }
                }

                ul {
                    overflow: visible;

                    &.header_links {

                        li {

                            a {

                            }
                        }
                    }
                }

            /*-------- 900PX NAV STYLE------*/

                nav {

                    & > ul {
                        flex-direction: row;
                        margin: 0;
                        padding: 0 20px;
                        overflow: initial;
                        width: initial;

                        & > li {
                            flex-grow: 1;
                            position: relative;

                            a {

                            }

                            button {

                                &::before {

                                }

                                span {

                                }
                            }

                            ul {
                                position: absolute;
                                z-index: 1;
                                width: auto;
                                left: 50%;
                                translate: -50%;
                            }
                        }
                    }
                }
            }

            /*-------- 900PX MAIN STYLE ------*/

            main {
                min-height: calc(100vh - 251.2px);

                &#home {

                    h2 {

                    }

                    img {

                    }

                    div {
                        &.image_overlay {
                            
                            &:first-child {
                                top: -60vh;
                            }

                        }
                    }

                }
                section {

                    /*****************************
                     * Style for product_items.php
                     *****************************/

                    &#item_wrapper {


                        h2 {

                        }

                        div {

                            &#image_wrapper {

                                img {

                                    &#product_item_image {

                                    }
                                }
                            }

                            &#details_wrapper {

                                div {

                                    &#item_details {

                                        p {
                                            &#group_info {

                                            }
                                        }

                                        div {

                                            &#item_options {

                                                div {

                                                    &#item_options_right_col {

                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    
                    /*****************************
                     * Style for shopping_cart.php
                     *****************************/

                    &#cart_items {

                        div {

                            &.cart_item {

                                img {
                                    
                                }

                                div {

                                    &.cart_item_info {

                                    }
                                }

                                input {

                                    &.remove_button {

                                    }
                                }
                            }
                        }

                        p {

                            &#total_display {

                            }
                        }

                        input {

                            &#checkout_button {

                            }
                        }
                    }
                }
            }

            /*-------- 900PX FOOTER STYLE ------*/

            footer {

            }
        }
    }
}

/*===============================
=== 1000PX CSS CODE AND UP =======
===============================*/

@media (min-width: 1000px) {

    html {

        body {

            /*-------- 1000PX HEADER STYLE ------*/

            header {

                h1 {

                    &#wrap_pas {

                    }

                    &#no_wrap_pas {

                    }
                }

                ul {

                    &.header_links {

                        li {

                            a {

                            }
                        }
                    }
                }
            }

            /*-------- 1000PX NAV STYLE------*/

            nav {

                ul{

                    li {

                        a {

                        }
                    }
                }
            }

            /*-------- 1000PX MAIN STYLE ------*/

           main {
                text-align: center;
                min-height: calc(100vh - 207.2px);
                background-color: lighten(@off-white, 3%);
                border-top: 1px solid @primary-color1;
                /* The style below hides the border when the navigation menu is collapsed */
                margin-top: -1px;
                letter-spacing: .1rem;
                overflow: hidden;

                &#home {

                    h2 {
                        top: -80vh;
                        font-size: 5em;
                    }

                    img {
                    }

                    div {
                        &.image_overlay {
                            top: -22vh;
                        }
                    }
                }

                h2 {

                }

                section {

                    /*****************************
                     * Style for product_groups.php
                     *****************************/

                    &#product_groups {

                    }

                    /*****************************
                     * Style for product_items.php
                     *****************************/

                    &#item_wrapper {
                        

                        h2 {

                        }

                        div {

                            &#image_wrapper {

                                img {

                                    &#product_item_image {

                                    }
                                }
                            }

                            &#details_wrapper {

                                div {

                                    &#item_details {

                                        p {
                                            &#group_info {

                                            }
                                        }

                                        div {

                                            &#item_options {

                                                div {

                                                    &#color_thumbnails_wrapper {

                                                        div {
                                                            
                                                            &#color_thumbnails {

                                                            }
                                                        }
                                                    }


                                                    &#image_wrapper {
                                                        
                                                        img {

                                                        }
                                                    }

                                                    &#drop_down_wrapper {

                                                        div {

                                                            &#item_options_right_col {

                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            /*-------- 1000PX FOOTER STYLE ------*/

            footer {

            }
        }
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

    html {

        body {

            /*-------- 1500PX HEADER STYLE ------*/

            header {

                h1 {

                    &#wrap_pas {

                    }

                    &#no_wrap_pas {

                    }
                }

                ul {

                    &.header_links {

                        li {

                            a {

                            }
                        }
                    }
                }
            }

            /*-------- 1500PX NAV STYLE------*/

            nav {

                ul{

                    li {

                        a {

                        }
                    }
                }
            }

            /*-------- 1500PX MAIN STYLE ------*/

           main {

                &#home {

                    h2 {
                        font-size: 7em;
                        top: -88vh;
                    }

                    img {

                    }

                    div {
                        &.image_overlay {

                        }
                    }
                }

                h2 {

                }

                section {

                    /*****************************
                     * Style for product_items.php
                     *****************************/

                    &#item_wrapper {

                        h2 {

                        }

                        div {

                            &#image_wrapper {

                                img {

                                    &#product_item_image {

                                    }
                                }
                            }

                            &#details_wrapper {

                                div {

                                    &#item_details {

                                        p {
                                            &#group_info {

                                            }
                                        }

                                        div {

                                            &#item_options {

                                                div {

                                                    &#color_thumbnails_wrapper {

                                                        div {
                                                            &#color_thumbnails {

                                                            }
                                                        }
                                                    }


                                                    &#image_wrapper {
                                                        
                                                        img {

                                                        }
                                                    }

                                                    &#drop_down_wrapper {

                                                        div {

                                                            &#item_options_right_col {

                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }

            /*-------- 1500PX FOOTER STYLE ------*/

            footer {

            }
        }
    }
}

/*===============================
=== 1600PX CSS CODE AND UP =======
===============================*/

@media (min-width: 1600px) {

    html body main section#product_groups {
        margin: 40px auto 20px auto;
    }
}     

/*===============================
=== 2040PX CSS CODE AND UP =======
===============================*/

@media (min-width: 2040px) {

    html body main section#cart_items div#cart_items_wrapper {
        margin: 40px auto 20px;
    }
}    