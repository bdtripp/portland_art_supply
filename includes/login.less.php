/*
<?php


header('Content-Type: text/css');
?>
*/

/*
 * Login/New Account Form
 */

 .CTA() {
  padding: 14px 80px;
  font-size: 1.3em;
  color: white;
  border: 3px solid #0AA764;
  border-radius: 40px;
  background-color: @primary-color1;
  font-weight: 900;
  letter-spacing: 1px;
  margin: 20px 0 0 0;
  line-height: 1.3rem;
}

.input_style() {
    padding: 10px 16px;
    font-size: 1.1em;
    border: 3px solid @dark-gray;
    color: @dark-gray;
    background-color: @off-white;
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

@primary-color1: #F34F0E;
@secondary-color1: #D90D4B;
@secondary-color2: #F3910E;
@secondary-color3: #B83906;
@complementary-color1: #0AA764;

@dark-gray: #333333;
@off-white: lighten(#F2F2F2, 4%);
@lightGrayBorder: #DDD;

html {

    body {
        font-family: 'Open Sans', sans-serif;
        background-color: white;
        color: @dark-gray;
        height: 100vh;
        display: grid;
        justify-content: center;
        align-items: center;

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
            display: grid;
            gap: 20px;
            justify-items: center;
            max-width: 370px;
            border: 3px solid @primary-color1;
            padding: 30px;
            border-radius: 10px;
            margin: 0 10px;
            background-color: @off-white;
            border-radius: 10px;
            box-shadow: 5px 5px 20px #AAA;

            h2 {
                font-size: 3rem;
                color: @secondary-color3;
                font-weight: bold;
                text-align: center;
                line-height: 1.2em;
            }

            div.form_row {
                display: flex;
                flex-direction: column;
                gap: 5px;

                label {
                    margin-right: 5px;
                    color: @dark-gray;
                    font-size: 1.1em;
                    letter-spacing: 1px;
                }

                input {
                    .input_style();
                    width: 175px;
                }
            }

            input {

                &.login_btn {
                    .CTA();
                    .hover1();
                    line-height: 1;
                    border: none;
                }

                &#create_account_btn {
                    .CTA();
                    padding: 16px 30px;
                    width: 228px;
                    border: none;
                }
            }


            div.links {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 20px;

                a {
                    text-decoration: none;
                    text-align: center;
                    .hover1();
                    .input_style();

                    &:visited {
                        color: @dark-gray;
                        background-color: @off-white;
                    }
                }
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

