<?php
require_once __DIR__ . '/../../../config.php';

use PAS\Config\LoginConstants;
use PAS\Services\LoginService;
use PAS\Infrastructure\Database;
use PAS\Config\PageConstants;
use PAS\Config\SecurityConstants;
use PAS\Repositories\UserRepository;
use PAS\Services\SessionService;
use PAS\Services\CsrfService;
use PAS\Repositories\AccountDataRepository;
use PAS\Support\RequestHelper;
use PAS\Services\CartService;

$requestHelper = new RequestHelper();
$errorStatus = new stdClass();
$db = new Database();
$userRepo = new UserRepository($db);
$accountDataRepo = new AccountDataRepository($db);
$sessionService = new SessionService($accountDataRepo);
$cartService = new CartService($sessionService);
$loginService = new LoginService($userRepo, $sessionService, $cartService);
$csrfService = new CsrfService($sessionService);

$login_username = $requestHelper->getPost(LoginConstants::LOGIN_USERNAME_KEY);
$login_password = $requestHelper->getPost(LoginConstants::LOGIN_PASSWORD_KEY);
$login_pressed = $requestHelper->getPost(LoginConstants::LOGIN_BUTTON_KEY);

if (!$login_pressed) {
    if (isset($_SERVER['HTTP_REFERER'])) {
        $sessionService->setReturnToUrl($_SERVER['HTTP_REFERER']);
    }
} else {
    $csrfService->guard($requestHelper);

    $errorStatus = $loginService->login($login_username, $login_password);
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
        <link href="css/reset.css.php" rel="stylesheet">
        <link href="css/login.css.php" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    </head>
    <body>
        <form method="POST" action="login.php">

            <input type="hidden"
                name="<?php echo SecurityConstants::CSRF_TOKEN_KEY; ?>"
                value="<?php echo $csrfService->getToken(); ?>">

            <h2>Log In</h2>
            <section>
                <label for="<?php echo LoginConstants::LOGIN_USERNAME_KEY; ?>">Username:</label>
                <input
                    id ="<?php echo LoginConstants::LOGIN_USERNAME_KEY; ?>"
                    type="text"
                    name="<?php echo LoginConstants::LOGIN_USERNAME_KEY; ?>"
                    value="<?php echo $login_username; ?>"
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
            <section>
                <label for="<?php echo LoginConstants::LOGIN_PASSWORD_KEY; ?>">Password:</label>
                <input
                    id="<?php echo LoginConstants::LOGIN_PASSWORD_KEY; ?>"
                    type="password" name="<?php echo LoginConstants::LOGIN_PASSWORD_KEY; ?>"
                    value="<?php echo $login_password; ?>"
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
            </section>
            <input id="<?php echo PageConstants::LOGIN_BUTTON_ID; ?>" type="submit" name="<?php echo LoginConstants::LOGIN_BUTTON_KEY; ?>" value="Log In" />
            <p>- or -</p>
            <div class="<?php echo PageConstants::LINKS_CLASS; ?>">
                <a id="<?php echo PageConstants::CREATE_ACCOUNT_LINK_ID; ?>" href="<?php echo PageConstants::CREATE_ACCOUNT_PAGE; ?>">Create an Account</a>
                <a id="<?php echo PageConstants::HOME_LINK_ID; ?>" href="<?php echo PageConstants::HOME_PAGE; ?>">Home</a>
            </div>
        </form>
    </body>
</html>
