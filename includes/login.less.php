/*
<?php


header('Content-Type: text/css');
?>
*/

/*
 * Login/New Account Form
 */

/* COLOR PALETTE */

@primary-color1: #F34F0E;
@secondary-color1: #D90D4B;
@secondary-color2: #F3910E;
@secondary-color3: #B83906;
@complementary-color1: #0AA764;

@dark-gray: #333333;
@off-white: #F2F2F2;
@lightGrayBorder: #DDD;

html {
    height: 100%;

    body {
        height: 100%;
        background-color: @off-white;
        color: @dark-gray;

        div {

            &#error_message_container {
                width: 200px;
                margin: 20px auto;
                border: 1px solid red;
                border-radius: 3px;
                padding: 10px;

                div {
                    &#error_header {
                        color: red;
                    }
                }
            }
        }

        form {
            border: 1px solid #DDD;
            border-radius: 5px;
            padding: 20px;
            height: 100%;
                
            div {

                &#login_form_header {
                    text-align: center;
                    font-size: 1.5em;
                    padding-bottom: 10px;
                }
            }

            div {





            }

            
            span {
                color: red;
            }

            label {
                display: inline-block;
                width: 4.5em;
                padding: 2px 0;
                text-align: right;
                vertical-align: top;
            }
        }
    }
}

