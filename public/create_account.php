<?php
session_start();

use PAS\Utilities;
use PAS\LoginConstants;
use PAS\LoginService;
use PAS\Database;
use PAS\PageConstants;

$createUsername = Utilities::getPostValue(LoginConstants::CREATE_USERNAME_KEY);
$createPassword = Utilities::getPostValue(LoginConstants::CREATE_PASSWORD_KEY);
$createConfirmPassword = Utilities::getPostValue(LoginConstants::CREATE_CONFIRM_PASSWORD_KEY);
$createPressed = Utilities::getPostValue(LoginConstants::CREATE_ACCOUNT_BUTTON_ID);
$errorStatus = new stdClass();
$loginService = new LoginService(new Database());

if ($createPressed) {
    $returnToUrl =  Utilities::getSessionValue(PageConstants::SESSION_RETURN_TO_URL);
    if ($returnToUrl != PageConstants::DOMAIN_NAME . PageConstants::CREATE_ACCOUNT_PAGE) {
        $errorStatus = $loginService->register($createUsername, $createPassword, $createConfirmPassword, $returnToUrl);
    } else {
        $errorStatus = $loginService->register($createUsername, $createPassword, $createConfirmPassword, PageConstants::HOME_PAGE);
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
        <link href="css/reset.css.php" rel="stylesheet">
        <link href="css/login.css.php" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <script src="js/create_account.js.php"></script>

    </head>
    <body>
        <form method="POST" action="create_account.php" onsubmit="return checkIfValid();">
            <h2>Create an Account</h2>
            <section>
                <label for="<?php echo PageConstants::USERNAME_INPUT_ID; ?>">Username:</label>
                <input 
                    id="<?php echo PageConstants::USERNAME_INPUT_ID; ?>" 
                    type="text" 
                    name="<?php echo LoginConstants::CREATE_USERNAME_KEY; ?>" 
                    value="<?php echo $createUsername; ?>"
                    required
                />
                <div class="<?php echo PageConstants::MESSAGE_WRAPPER_CLASS; ?>">
                    <span class="<?php echo PageConstants::ERROR_SYMBOL_CLASS; ?>">
                        <?php echo isset($errorStatus->usernameError) ? $loginService->showErrorSymbol() : '' ?>
                    </span>
                    <span id="<?php echo PageConstants::USERNAME_MESSAGE_ID; ?>" class="<?php echo PageConstants::MESSAGE_CLASS; ?>">
                        <?php echo isset($errorStatus->usernameError) ? $errorStatus->usernameError : '' ?>
                    </span>
                </div>
            </section>
            <section id="<?php echo PageConstants::PASSWORD_SECTION_CLASS ?>">
                <div class="<?php echo PageConstants::WRAPPER_CLASS; ?>">
                    <label for="<?php echo PageConstants::PASSWORD_INPUT_ID; ?>">Password:</label>
                    <input 
                        id="<?php echo PageConstants::PASSWORD_INPUT_ID; ?>" 
                        type="password" name="<?php echo LoginConstants::CREATE_PASSWORD_KEY; ?>" 
                        value="<?php echo $createPassword; ?>" 
                        required
                    />
                    <div class="<?php echo PageConstants::MESSAGE_WRAPPER_CLASS; ?>">
                        <span class="<?php echo PageConstants::ERROR_SYMBOL_CLASS; ?>">
                            <?php echo isset($errorStatus->passwordError) ? $loginService->showErrorSymbol() : '' ?>
                        </span>
                        <span id="<?php echo PageConstants::PASSWORD_MESSAGE_ID; ?>" class="<?php echo PageConstants::MESSAGE_CLASS; ?>">
                            <?php echo isset($errorStatus->passwordError) ? $errorStatus->passwordError : '' ?>
                        </span>
                    </div>
                </div>
                <p>Password requirements:</p>
                <ul class="<?php echo PageConstants::REQUIREMENTS_CLASS; ?>">
                    <li id="<?php echo PageConstants::UPPERCASE_REQUIREMENT_ID; ?>"><?php echo LoginConstants::PASSWORD_UPPERCASE_REQUIRE; ?></li>
                    <li id="<?php echo PageConstants::DIGIT_REQUIREMENT_ID; ?>"><?php echo LoginConstants::PASSWORD_DIGIT_REQUIRE; ?></li>
                    <li id="<?php echo SPECIAL_CHAR_REQUIREMENT_ID; ?>">
                        <?php echo LoginConstants::PASSWORD_SPECIAL_REQUIRE; ?>
                        <span><?php echo LoginConstants::REQUIRED_SPECIAL_CHARACTERS ?></span>
                    </li>
                    <li id="<?php echo PageConstants::LENGTH_REQUIREMENT_ID; ?>"><?php echo LoginConstants::PASSWORD_LENGTH_REQUIRE; ?></li>
                </ul>
            </section>
            <section>
                <label for="<?php echo PageConstants::CONFIRM_PASSWORD_INPUT_ID; ?>">Confirm Password:</label>
                <input 
                    id="<?php echo PageConstants::CONFIRM_PASSWORD_INPUT_ID; ?>" 
                    type="password" name="<?php echo LoginConstants::CREATE_CONFIRM_PASSWORD_KEY; ?>" 
                    value="<?php echo $createConfirmPassword; ?>" 
                    required
                />
                <div class="<?php echo PageConstants::MESSAGE_WRAPPER_CLASS; ?>">
                    <span class="<?php echo PageConstants::ERROR_SYMBOL_CLASS; ?>">
                        <?php echo isset($errorStatus->confirmPassError) ? $loginService->showErrorSymbol() : '' ?>
                    </span>
                    <span id="<?php echo PageConstants::CONFIRM_PASSWORD_MESSAGE_ID; ?>" class="<?php echo PageConstants::MESSAGE_CLASS; ?>">
                        <?php echo isset($errorStatus->confirmPassError) ? $errorStatus->confirmPassError : '' ?>
                    </span>
                </div>
           </section>
            <input 
                id="<?php echo PageConstants::CREATE_ACCOUNT_BUTTON_ID; ?>" 
                type="submit" 
                name="<?php echo PageConstants::CREATE_ACCOUNT_BUTTON_ID; ?>" 
                value="Create Account" 
            />
            <p>- or -</p>
            <div class="<?php echo PageConstants::LINKS_CLASS; ?>">
                <a id="<?php echo PageConstants::LOGIN_LINK_ID; ?>" href="<?php echo PageConstants::LOGIN_PAGE; ?>">Log In</a>
                <a id="<?php echo PageConstants::HOME_LINK_ID; ?>" href="<?php echo PageConstants::HOME_PAGE; ?>">Home</a>
            </div>
        </form>
    </body>
</html>
