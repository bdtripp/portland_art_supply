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
  background-color: @complementary-color1;
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

    body {
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

            h2 {
                font-size: 2rem;
                text-align: center;
            }

            div.form_row {
                display: flex;
                flex-direction: column;

                input {
                    .input_style();
                    flex: 1 1 0;
                    min-width: 0;

                    &[type="submit"] {
                        .CTA();
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

