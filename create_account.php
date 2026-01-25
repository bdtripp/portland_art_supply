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

$create_username = get_post_value(CREATE_USERNAME_KEY);
$create_password = get_post_value(CREATE_PASSWORD_KEY);
$create_confirm_password = get_post_value(CREATE_CONFIRM_PASSWORD_KEY);
$create_pressed = get_post_value(CREATE_ACCOUNT_BUTTON_ID);
$error_message = '';

if ($create_pressed) {
    $returnToUrl = get_session_value(SESSION_RETURN_TO_URL);
    if ($returnToUrl != DOMAIN_NAME . CREATE_ACCOUNT_PAGE) {
        $error_message = register($create_username, $create_password, $create_confirm_password, $returnToUrl);
    } else {
        $error_message = register($create_username, $create_password, $create_confirm_password, HOME_PAGE);
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
    <?php echo $error_message; ?>
        <form method="POST" action="create_account.php" onsubmit="return checkIfValid();">
            <h2>Create a New Account</h2>
            <div class="form_row">
                    <label>Username:</label>
                    <input 
                        id="<?php echo USERNAME_INPUT_ID; ?>" 
                        type="text" 
                        name="<?php echo CREATE_USERNAME_KEY; ?>" 
                        value="<?php echo $create_username; ?>"
                    />
            </div>
            <span id="<?php echo USERNAME_MESSAGE_ID; ?>" class="<?php echo MESSAGE_CLASS; ?>"></span>
            <div class="form_row">
                <label>Password:</label>
                <input 
                    id="<?php echo PASSWORD_INPUT_ID; ?>" 
                    type="password" name="<?php echo CREATE_PASSWORD_KEY; ?>" 
                    value="<?php echo $create_password; ?>" 
                />
            </div>
            <span id="<?php echo PASSWORD_MESSAGE_ID; ?>" class="<?php echo MESSAGE_CLASS; ?>"></span>
            <div class="form_row">
                <label>Confirm Password:</label>
                <input 
                    id="<?php echo CONFIRM_PASSWORD_INPUT_ID; ?>" 
                    type="password" name="<?php echo CREATE_CONFIRM_PASSWORD_KEY; ?>" 
                    value="<?php echo $create_confirm_password; ?>" 
                />
            </div>
            <span id="<?php echo CONFIRM_PASSWORD_MESSAGE_ID; ?>" class="<?php echo MESSAGE_CLASS; ?>"></span>
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
