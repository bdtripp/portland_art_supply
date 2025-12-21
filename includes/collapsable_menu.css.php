<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/28/2018
 * Time: 6:07 PM
 */

header('Content-Type: text/css');
?>

/* Based on http://kmturley.blogspot.com/2014/06/responsive-mobile-dropdown-navigation.html */
/* Modified for mobile-first design */

/* remove bullet in front of list items in menu */

header ul {
    list-style-type: none;
    overflow: hidden;
}

/* clear float on line below */

nav .menu {
    clear: both;
    max-height: 0;
    transition: max-height 1s ease-out;
}

/* menu icon for responsive hamburger menu */

header .menu-icon { /* location of hamburger icon */
    cursor: pointer;
    display: inline-block;
    float: left;
    padding: 28px 20px;
    position: relative;
    margin-top: 0;
    margin-bottom: 0;
}

header .menu-icon .navicon { /* center line of hamburger icon */
    background: #333;
    display: block;
    height: 2px;
    position: relative;
    transition: background .2s ease-out;
    width: 18px;
}

header .menu-icon .navicon:before, /* top and bottom lines of hamburger icon */
header .menu-icon .navicon:after {
    background: #333;
    content: '';
    display: block;
    height: 100%;
    position: absolute;
    transition: all .2s ease-out;
    width: 100%;
}

header .menu-icon .navicon:before {
    top: 5px;
}

header .menu-icon .navicon:after {
    top: -5px;
}

/* respond to click on hamburger menu icon */

header .menu-btn { /* hide checkbox */
    display: none;
}

header .menu-btn:checked ~  nav .menu {
    max-height: 350px;
}

header .menu-btn:checked ~ .menu-icon .navicon {
    background: transparent;
}

/* animations */

header .menu-btn:checked ~ .menu-icon .navicon:before {
    transform: rotate(-45deg);
}

header .menu-btn:checked ~ .menu-icon .navicon:after {
    transform: rotate(45deg);
}

header .menu-btn:checked ~ .menu-icon:not(.steps) .navicon:before,
header .menu-btn:checked ~ .menu-icon:not(.steps) .navicon:after {
    top: 0;
}

/*  TABLET AND DESKTOP: CREATE HORIZONTAL NAVIGATION BAR */
@media only screen and (min-width: 900px) {

    /* Note: We float the entire menu to the right, so it is right-aligned. Then we float each list item to the left, so it sits to next to the next item. We have to clear the float in the following section so the text won't wrap around the menu. */

    nav .menu {
        float: left;
        max-height: none;
    }

    header ul {
        padding: 2px 0;
    }

    header ul.menu li {
        float: left;
    }

    header li a {
        padding: 10px 10px;
    }

    main {
        clear: both;
    }

    /* hide the checkbox and label for it */

    header .menu-icon, .menu-btn {
        display: none;
    }

}


