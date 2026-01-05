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

.clearfloat {
    clear: both;
}

.price_display {
    color: red;
}

.required {
    color: red;
}

.card {
    background-color: white;
    border-radius: 10px;
}

/*===============================
===== MOBILE CSS CODE AND UP ======
===============================*/

.hide_in_mobile {
    display: none;
}

html {
    overflow: auto;

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
                    10deg, 
                    @primary-color1 ,
                    @primary-color1 19vw,  
                    @secondary-color1 19vw,
                    @secondary-color1
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
                                        top: 26%;
                                        left: 50%;
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

                    li {
                        text-align: center;
                        border-radius: 5px;

                        &:hover {
                            background-color: #EEE;
                        }

                        &.active {
                            /* This style identifies the page the user is currently on */
                            background-color: #DDD;
                        }

                        a {
                            text-decoration: none;
                            font-size: 1.5rem;
                            color: black;
                            display: block;
                            padding: 6px 0;
                            margin: 1px 0;

                            &:hover {
                                opacity: .8;
                            }

                            &:visited {
                                color: @dark-gray;
                            }
                        }
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
                background: linear-gradient(
                    355deg,
                    @secondary-color2,
                    @secondary-color2 21vh,
                    @secondary-color1 192vh,
                    @secondary-color1
                );
                min-height: 200vh;

                h2 {
                    position: relative;
                    top: -59vh;
                    left: 3vh;
                    font-size: 2.8em;
                    font-weight: 900;
                    text-align: left;
                }

                img {
                    transform: scaleX(-1);
                }

                div {
                    &.image_overlay {
                        position: relative;
                        top: -8vh;
                        height: 57vh;
                        background-color: #F3910E;
                        transform: rotate(10deg);
                        width: 150vw;
                        left: -15vh;

                        &:first-child {
                            display: none;
                        }
                    }
                }

            }

            h2 {
                font-size: 2rem;
                margin: 20px auto;
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
                 * Style for product_group.php
                 *****************************/

                &#product_groups {

                    div {

                        &.group_row {
                            overflow: hidden;

                        }
                    }

                    div {

                        &.product_group {
                            padding: 20px 0 0 0;
                            box-shadow: 5px 5px 20px #AAA;
                            margin: 15px auto;

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
                            }
                        }
                    }
                }

                /*****************************
                * Style for product_items.php
                *****************************/

                &#item_wrapper {
                    overflow: hidden;

                    h2 {
                        &#non_mobile_version {
                            display: none;
                        }
                    }

                    div {

                        &#image_wrapper {

                            img {

                                &#product_item_image {

                                }
                            }
                        }

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
                                    overflow: hidden;

                                    div {

                                        &#item_options_right_col {
                                            margin: 20px 0;

                                            p {

                                                &#price {

                                                    span {

                                                        &.price_display {
                                                            font-size: 1.2rem;
                                                        }
                                                    }
                                                }
                                            }

                                            div {

                                                &#drop_down_options {

                                                    div {
                                                        margin: 15px 0;

                                                        p {
                                                            display: inline;
                                                        }

                                                        &#color {
                                                            white-space: nowrap;
                                                        }

                                                        &#size {

                                                        }

                                                        &#quantity {

                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }

                                &#color_thumbnails {
                                    line-height: 0;
                                    margin-bottom: 20px;

                                    img {
                                        border: 1px solid black;
                                        border-radius: 3px;
                                        margin: 2px;
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

                        &.cart_item {
                            overflow: hidden;
                            box-shadow: 5px 5px 20px #AAA;
                            margin: 15px auto;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            flex-wrap: wrap;
                            font-size: .8rem;
                            width: 97%;

                            img {
                                float: left;
                                width: 28%;
                            }

                            div {

                                &.cart_item_info {
                                    padding: 10px 1%;
                                    width: 70%;

                                    p, input {
                                        margin: 5px 0;
                                    }

                                    div {

                                        &.cart_item_specs {

                                            p:first-child {
                                                margin-bottom: 10px;
                                            }

                                        }

                                        &.quantity_and_subtotal {
                                            overflow: hidden;

                                            div {

                                                &.quantity {
                                                    margin: 0 0 10px 0;

                                                    p {
                                                        display: inline;
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    p {

                                        &.price_display {
                                            margin: 10px 0;
                                        }
                                    }
                                }
                            }

                            input {

                                &.remove_button {
                                    margin: 0 0 10px 0;
                                }
                            }
                        }
                    }

                    p {

                        &#total_display {
                            margin: 20px 0;
                            font-size: 1rem;
                        }
                    }

                    input {

                        &#checkout_button {
                            margin-bottom: 20px;
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
                background-color: #222;
                opacity: .9;


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

                        ul {

                            li {
                                display: inline;

                                a {
                                    padding: 0 1.2%;

                                    &:hover {
                                        opacity: .9;
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

                    &#mobile_version {

                    }
                }

                section {

                    /*****************************
                     * Style for product_items.php
                     *****************************/

                    &#item_wrapper {
                        
                        h2 {

                            &#non_mobile_version {

                            }
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

                                                    &#right_col_wrapper {

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
                background: linear-gradient(
                    10deg, 
                    @primary-color1 ,
                    @primary-color1 10vw,  
                    @secondary-color1 10vw,
                    @secondary-color1
                );

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
                position: relative;

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

                    &#mobile_version {

                    }
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

                            &.group_row {
                                border-bottom: 1px solid @lightGrayBorder;
                                display: flex;
                                border: none;
                                justify-content: center;

                                &:first-child {
                                    margin-top: 20px;
                                }

                                div {

                                    &.product_group {
                                        border: 1px solid @lightGrayBorder;
                                        display: flex;
                                        flex-wrap: wrap;
                                        justify-content: center;
                                        margin: 0 0 10px 10px;

                                        &:first-child {
                                            margin-left: 0;
                                        }

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
                        }
                    }

                    /*****************************
                     * Style for product_items.php
                     *****************************/

                    &#item_wrapper {

                        p {

                            &#group_info {
                                display: block;
                                width: 80%;
                                margin: 0 auto;
                            }
                        }

                        h2 {

                            &#non_mobile_version {

                            }
                        }

                        div {

                            &#image_wrapper {
                                width: 25%;

                                img {

                                    &#product_item_image {

                                    }
                                }
                            }

                            &#details_wrapper {
                                width: 100%;

                                div {

                                    &#item_details {

                                        div {

                                            &#item_options {
                                                margin-top: 20px;
                                                height: 328px;

                                                div {

                                                    &#color_thumbnails_wrapper {
                                                        margin-left: 0;
                                                        height: 100%;
                                                        position: relative;
                                                        width: 25%;

                                                        div {

                                                            &#color_thumbnails {
                                                                position: absolute;
                                                                top: 50%;
                                                                left: 50%;
                                                                transform: translate(-50%, -50%);
                                                                width: 100%;
                                                            }
                                                        }
                                                    }

                                                    &#image_wrapper {
                                                        margin-left: 0;
                                                        height: 100%;
                                                        position: relative;
                                                        width: 33%;


                                                        img {
                                                            position: absolute;
                                                            top: 50%;
                                                            left: 50%;
                                                            transform: translate(-50%, -50%);
                                                            margin: 0;
                                                        }
                                                    }

                                                    &#right_col_wrapper {
                                                        width: 20%;
                                                        height: 100%;
                                                        position: relative;
                                                        margin: 0;
                                                        width: 37%;

                                                            div {
                                                                &#item_options_right_col {
                                                                    position: absolute;
                                                                    top: 50%;
                                                                    left: 50%;
                                                                    transform: translate(-50%, -50%);
                                                                    margin: 0;
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

                            &.cart_item {
                                flex-wrap: nowrap;
                                position: relative;

                                img {
                                    width: 22%;
                                }

                                div {

                                    &.cart_item_info {
                                        width: 100%;
                                        margin-left: 0;
                                        
                                        p, input {
                                            font-size : 1rem;
                                        }

                                        div {

                                            &.cart_item_specs {
                                                margin: 0;

                                                p:first-child {
                                                    margin-top: 0;
                                                    margin-bottom: 20px;
                                                }

                                            }

                                            &.quantity_and_subtotal {
                                                width: 56%;                                           display: flex;
                                                margin: 0;
                                                

                                                div {

                                                    &.quantity {

                                                        p {

                                                        }
                                                    }
                                                }

                                                p {

                                                    &.subtotal {
                                                        margin: 0;
                                                        width: 51%;
                                                    }
                                                }
                                            }
                                        }

                                        p {

                                            &.price_display {
                                                margin: 0;
                                            }
                                        }
                                    }
                                }

                                input {

                                    &.remove_button {
                                        padding: 2px;
                                        position: absolute;
                                        right: 10px;
                                        bottom: 0px;
                                    }
                                }
                            }
                        }

                        p {

                            &#total_display {
                                margin: 20px 0;
                                font-size: 1.2rem;
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
                                        padding: 0 .5%;
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

                    &.header_links {

                        li {

                            a {

                            }
                        }
                    }
                }

            /*-------- 900PX NAV STYLE------*/

                nav {

                    ul{
                        margin: 2px 0;
                        width: 100%;

                        li {
                            margin-left: 2px;
                            /* This spaces out the navigation buttons evenly */
                            width: 12%;

                            a {
                                /* This style adjusts the width of the navigation buttons */
                                padding: 5px 10%;
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

                            &#non_mobile_version {

                            }
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

                                        p, input {

                                        }

                                        div {

                                            &.cart_item_specs {

                                                p:first-child {

                                                }

                                            }

                                            &.quantity_and_subtotal {


                                                div {

                                                    &.quantity {

                                                        p {

                                                        }
                                                    }
                                                }

                                                p {

                                                    &.subtotal {

                                                    }
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
                border-top: 1px dotted @primary-color1;
                /* The style below hides the dotted border when the navigation menu is collapsed */
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

                    &#mobile_version {
                        display: none;
                    }
                }

                section {

                    /*****************************
                     * Style for product_items.php
                     *****************************/

                    &#item_wrapper {
                        height: 650px;
                        padding: 15px;
                        

                        h2 {

                            &#non_mobile_version {
                                font-size: 2rem;
                                display: block;
                            }
                        }

                        div {

                            &#image_wrapper {
                                width: 42%;
                                height: 100%;
                                position: relative;
                                box-shadow: 5px 5px 20px #AAA;
                                margin: 0;

                                img {

                                    &#product_item_image {
                                        position: absolute;
                                        top: 0;
                                        bottom: 0;
                                        left: 0;
                                        right: 0;
                                        margin: auto;
                                    }
                                }
                            }

                            &#details_wrapper {
                                height: 100%;
                                width: 56.67%;
                                position: relative;
                                box-shadow: 5px 5px 20px #AAA;
                                margin: 0 0 0 10px;

                                div {

                                    &#item_details {
                                        overflow: hidden;
                                        position: absolute;
                                        top: 0;
                                        bottom: 0;
                                        right: 0;
                                        left: 0;
                                        margin: auto;
                                        height: min-content;

                                        p {
                                            &#group_info {
                                                margin: 0 auto 40px auto;
                                                width: 80%;
                                                display: block;
                                            }
                                        }

                                        div {

                                            &#item_options {
                                                height: 350px;

                                                div {

                                                    &#color_thumbnails_wrapper {
                                                        width: 50%;

                                                        div {
                                                            &#color_thumbnails {
                                                                margin-left: 2%;
                                                            }
                                                        }
                                                    }


                                                    &#image_wrapper {
                                                        
                                                        img {

                                                        }
                                                    }

                                                    &#right_col_wrapper {
                                                        margin: 0;
                                                        overflow: hidden;
                                                        width: 50%;

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
                    }

                    img {

                    }

                    div {
                        &.image_overlay {

                        }
                    }
                }

                h2 {

                    &#mobile_version {

                    }
                }

                section {

                    /*****************************
                     * Style for product_items.php
                     *****************************/

                    &#item_wrapper {

                        h2 {

                            &#non_mobile_version {

                            }
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

                                                    &#right_col_wrapper {

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