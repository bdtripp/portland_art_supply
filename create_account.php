<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/21/2018
 * Time: 12:38 PM
 */

require_once('includes/utilities.php');
require_once('includes/login_constants.php');
require_once('includes/login_code.php');
require_once('includes/db_constants.php');
require_once('includes/db_code.php');
require_once('includes/page_constants.php');

session_start();

$create_username = get_post_value(CREATE_USERNAME_KEY);
$create_password = get_post_value(CREATE_PASSWORD_KEY);
$create_confirm_password = get_post_value(CREATE_CONFIRM_PASSWORD_KEY);
$create_pressed = get_post_value(CREATE_BUTTON_VALUE);
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
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PAS | Create Account</title>
    <link href="includes/reset.css.php" rel="stylesheet">
    <link href="includes/login.css.php" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="http://bdtripp.com/portland_art_supply/images/favicon.ico">
    <!--    <link href="includes/login.less.php" rel="stylesheet/less">-->
    <!--    <script src="includes/less.js.php"></script>-->
    <script src="includes/create_account.js.php"></script>

</head>
<body>
<?php echo $error_message; ?>
<div class="login wrapper">
    <form method="POST" action="create_account.php" onsubmit="return checkIfValid();">
        <table class="login_table center">
            <tr>
                <th class="login_form_header" colspan="2">Create a New Account</th>
            </tr>
            <tr>
                <td>
                    <label>Username:</label>
                </td>
                <td>
                    <input id="<?php echo USERNAME_INPUT_ID; ?>" type="text" name="<?php echo CREATE_USERNAME_KEY; ?>" value="<?php echo $create_username; ?>">
                </td>
            </tr>
            <tr>
                <td class="<?php echo MESSAGE_TD; ?>" colspan="2">
                    <span id="<?php echo USERNAME_MESSAGE_ID; ?>"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Password:</label>
                </td>
                <td>
                    <input id="<?php echo PASSWORD_INPUT_ID; ?>" type="password" name="<?php echo CREATE_PASSWORD_KEY; ?>" value="<?php echo $create_password; ?>">
                </td>
            </tr>
            <tr>
                <td class="<?php echo MESSAGE_TD; ?>" colspan="2">
                    <span id="<?php echo PASSWORD_MESSAGE_ID; ?>"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Confirm Password:</label>
                </td>
                <td>
                    <input id="<?php echo CONFIRM_PASSWORD_INPUT_ID; ?>" type="password" name="<?php echo CREATE_CONFIRM_PASSWORD_KEY; ?>" value="<?php echo $create_confirm_password; ?>">
                </td>
            </tr>
            <tr>
                <td class="<?php echo MESSAGE_TD; ?>" colspan="2">
                    <span id="<?php echo CONFIRM_PASSWORD_MESSAGE_ID; ?>"></span>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input class="login_btn" type="submit" name="<?php echo CREATE_BUTTON_VALUE; ?>" value="Create"></td>
            </tr>
            <tr>
                <td id="<?php echo LINKS_TD_ID; ?>" colspan="2">
                    <a href="<?php echo LOGIN_PAGE; ?>">Login</a>
                    <a href="<?php echo HOME_PAGE; ?>">Home</a>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
