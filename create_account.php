<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/21/2018
 * Time: 12:38 PM
 */
session_start();

require_once('includes/utilities.php');
require_once('includes/login_constants.php');
require_once('includes/login_code.php');
require_once('includes/db_constants.php');
require_once('includes/db_code.php');
require_once('includes/page_constants.php');

$createUsername = get_post_value(CREATE_USERNAME_KEY);
$createPassword = get_post_value(CREATE_PASSWORD_KEY);
$createConfirmPassword = get_post_value(CREATE_CONFIRM_PASSWORD_KEY);
$createPressed = get_post_value(CREATE_ACCOUNT_BUTTON_ID);
$errorStatus = new stdClass();

if ($createPressed) {
    $returnToUrl = get_session_value(SESSION_RETURN_TO_URL);
    if ($returnToUrl != DOMAIN_NAME . CREATE_ACCOUNT_PAGE) {
        $errorStatus = register($createUsername, $createPassword, $createConfirmPassword, $returnToUrl);
    } else {
        $errorStatus = register($createUsername, $createPassword, $createConfirmPassword, HOME_PAGE);
    }
}

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

        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PAS | Create Account</title>
        <link href="includes/reset.css.php" rel="stylesheet">
        <link href="includes/login.css.php" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <script src="includes/create_account.js.php"></script>

    </head>
    <body>
        <form method="POST" action="create_account.php" onsubmit="return checkIfValid();"> <!--  -->
            <h2>Create an Account</h2>
            <section>
                <label for="<?php echo USERNAME_INPUT_ID; ?>">Username:</label>
                <input 
                    id="<?php echo USERNAME_INPUT_ID; ?>" 
                    type="text" 
                    name="<?php echo CREATE_USERNAME_KEY; ?>" 
                    value="<?php echo $createUsername; ?>"
                    required
                    <?php //required ?>
                />
                <div class="<?php echo MESSAGE_WRAPPER_CLASS; ?>">
                    <span class="<?php echo ERROR_SYMBOL_CLASS; ?>">
                        <?php echo isset($errorStatus->usernameError) ? showErrorSymbol() : '' ?>
                    </span>
                    <span id="<?php echo USERNAME_MESSAGE_ID; ?>" class="<?php echo MESSAGE_CLASS; ?>">
                        <?php echo isset($errorStatus->usernameError) ? $errorStatus->usernameError : '' ?>
                    </span>
                </div>
            </section>
            <section id="<?php echo PASSWORD_SECTION_CLASS ?>">
                <div class="<?php echo WRAPPER_CLASS; ?>">
                    <label for="<?php echo PASSWORD_INPUT_ID; ?>">Password:</label>
                    <input 
                        id="<?php echo PASSWORD_INPUT_ID; ?>" 
                        type="password" name="<?php echo CREATE_PASSWORD_KEY; ?>" 
                        value="<?php echo $createPassword; ?>" 
                        required
                        <?php //required ?>
                    />
                    <div class="<?php echo MESSAGE_WRAPPER_CLASS; ?>">
                        <span class="<?php echo ERROR_SYMBOL_CLASS; ?>">
                            <?php echo isset($errorStatus->passwordError) ? showErrorSymbol() : '' ?>
                        </span>
                        <span id="<?php echo PASSWORD_MESSAGE_ID; ?>" class="<?php echo MESSAGE_CLASS; ?>">
                            <?php echo isset($errorStatus->passwordError) ? $errorStatus->passwordError : '' ?>
                        </span>
                    </div>
                </div>
                <p>Password requirements:</p>
                <ul class="<?php echo REQUIREMENTS_CLASS; ?>">
                    <li id="<?php echo UPPERCASE_REQUIREMENT_ID; ?>"><?php echo PASSWORD_UPPERCASE_REQUIRE; ?></li>
                    <li id="<?php echo DIGIT_REQUIREMENT_ID; ?>"><?php echo PASSWORD_DIGIT_REQUIRE; ?></li>
                    <li id="<?php echo SPECIAL_CHAR_REQUIREMENT_ID; ?>">
                        <?php echo PASSWORD_SPECIAL_REQUIRE; ?>
                        <span><?php echo REQUIRED_SPECIAL_CHARACTERS ?></span>
                    </li>
                    <li id="<?php echo LENGTH_REQUIREMENT_ID; ?>"><?php echo PASSWORD_LENGTH_REQUIRE; ?></li>
                </ul>
            </section>
            <section>
                <label for="<?php echo CONFIRM_PASSWORD_INPUT_ID; ?>">Confirm Password:</label>
                <input 
                    id="<?php echo CONFIRM_PASSWORD_INPUT_ID; ?>" 
                    type="password" name="<?php echo CREATE_CONFIRM_PASSWORD_KEY; ?>" 
                    value="<?php echo $createConfirmPassword; ?>" 
                    required
                    <?php //required ?>
                />
                <div class="<?php echo MESSAGE_WRAPPER_CLASS; ?>">
                    <span class="<?php echo ERROR_SYMBOL_CLASS; ?>">
                        <?php echo isset($errorStatus->confirmPassError) ? showErrorSymbol() : '' ?>
                    </span>
                    <span id="<?php echo CONFIRM_PASSWORD_MESSAGE_ID; ?>" class="<?php echo MESSAGE_CLASS; ?>">
                        <?php echo isset($errorStatus->confirmPassError) ? $errorStatus->confirmPassError : '' ?>
                    </span>
                </div>
           </section>
            <input 
                id="<?php echo CREATE_ACCOUNT_BUTTON_ID; ?>" 
                type="submit" 
                name="<?php echo CREATE_ACCOUNT_BUTTON_ID; ?>" 
                value="Create Account" 
            />
            <p>- or -</p>
            <div class="<?php echo LINKS_CLASS; ?>">
                <a id="<?php echo LOGIN_LINK_ID; ?>" href="<?php echo LOGIN_PAGE; ?>">Log In</a>
                <a id="<?php echo HOME_LINK_ID; ?>" href="<?php echo HOME_PAGE; ?>">Home</a>
            </div>
        </form>
    </body>
</html>
