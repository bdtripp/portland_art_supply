<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/21/2018
 * Time: 11:31 AM
 *
 * TODO: in head, remove script link to local js file and uncomment the script link to the one on cdn
 *
 */
session_start();

require_once('includes/utilities.php');
require_once('includes/login_constants.php');
require_once('includes/login_code.php');
require_once('includes/db_constants.php');
require_once('includes/db_code.php');
require_once('includes/page_constants.php');

$login_username = get_post_value(LOGIN_USERNAME_KEY);
$login_password = get_post_value(LOGIN_PASSWORD_KEY);
$login_pressed = get_post_value(LOGIN_BUTTON_VALUE);
$errorStatus = new stdClass();

if (!$login_pressed && isset($_SERVER['HTTP_REFERER'])) {
    set_session_value(SESSION_RETURN_TO_URL, $_SERVER['HTTP_REFERER']);
} else {
    $returnToUrl = get_session_value(SESSION_RETURN_TO_URL);
    if ($returnToUrl != DOMAIN_NAME . CREATE_ACCOUNT_PAGE) {
        $errorStatus = login($login_username, $login_password, $returnToUrl);
    } else {
        $errorStatus = login($login_username, $login_password, HOME_PAGE);
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
        <title>PAS | Login</title>
        <link href="includes/reset.css.php" rel="stylesheet">
        <link href="includes/login.css.php" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    </head>
    <body>
        <form method="POST" action="login.php">
            <h2>Log In</h2>
            <section>
                <label for="<?php echo LOGIN_USERNAME_KEY; ?>">Username:</label>
                <input 
                    id ="<?php echo LOGIN_USERNAME_KEY; ?>" 
                    type="text" 
                    name="<?php echo LOGIN_USERNAME_KEY; ?>" 
                    value="<?php echo $login_username; ?>"
                    required
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
            <section>
                <label for="<?php echo LOGIN_PASSWORD_KEY; ?>">Password:</label>
                <input 
                    id="<?php echo LOGIN_PASSWORD_KEY; ?>" 
                    type="password" name="<?php echo LOGIN_PASSWORD_KEY; ?>" 
                    value="<?php echo $login_password; ?>" 
                    required
                />
                <div class="<?php echo MESSAGE_WRAPPER_CLASS; ?>">
                    <span class="<?php echo ERROR_SYMBOL_CLASS; ?>">
                        <?php echo isset($errorStatus->passwordError) ? showErrorSymbol() : '' ?>
                    </span>
                    <span id="<?php echo PASSWORD_MESSAGE_ID; ?>" class="<?php echo MESSAGE_CLASS; ?>">
                        <?php echo isset($errorStatus->passwordError) ? $errorStatus->passwordError : '' ?>
                    </span>
                </div>
            </section>
            <input class="login_btn" type="submit" name="<?php echo LOGIN_BUTTON_VALUE; ?>" value="Log In" />
            <p>- or -</p>
            <div class="<?php echo LINKS_CLASS; ?>">
                <a id="<?php echo CREATE_ACCOUNT_LINK_ID; ?>" href="<?php echo CREATE_ACCOUNT_PAGE; ?>">Create an Account</a>
                <a id="<?php echo HOME_LINK_ID; ?>" href="<?php echo HOME_PAGE; ?>">Home</a>
            </div>
        </form>
    </body>
</html>
