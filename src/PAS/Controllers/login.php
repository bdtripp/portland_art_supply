<?php
require_once __DIR__ . '/../../../config.php';

use PAS\Config\LoginConstants;
use PAS\Services\LoginService;
use PAS\Infrastructure\Database;
use PAS\Config\PageConstants;
use PAS\Config\SecurityConstants;
use PAS\Repositories\UserRepository;
use PAS\Services\SessionManager;
use PAS\Services\CsrfService;
use PAS\Repositories\AccountRepository;
use PAS\Support\RequestHelper;
use PAS\Services\CartService;

$loginErrors = null;

$db = new Database();

$userRepository = new UserRepository($db);
$accountRepository = new AccountRepository($db);

$sessionManager = new SessionManager($accountRepository);
$cartService = new CartService($sessionManager);
$loginService = new LoginService($userRepository, $sessionManager, $cartService);
$csrfService = new CsrfService($sessionManager);

$requestHelper = new RequestHelper();

$login_username = $requestHelper->getPostString(LoginConstants::LOGIN_USERNAME_KEY);
$login_password = $requestHelper->getPostString(LoginConstants::LOGIN_PASSWORD_KEY);
$login_pressed = $requestHelper->isKeySet(LoginConstants::LOGIN_BUTTON_KEY);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrfService->guard($requestHelper);
}

if (!$login_pressed) {
    if (isset($_SERVER['HTTP_REFERER'])) {
        $sessionManager->setReturnToUrl($_SERVER['HTTP_REFERER']);
    }
} else {
    $loginErrors = $loginService->login($login_username, $login_password);
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex, nofollow">
        <meta name="description" content="Secure login page for PAS. Sign in to access your account, manage your cart, and continue where you left off.">
        <title>PAS | Login</title>
        <link href="css/reset.css" rel="stylesheet">
        <link href="css/login.css" rel="stylesheet">
        <link rel="icon" href="images/favicon.ico">
    </head>
    <body>
        <form method="POST" action="login.php">
            <input type="hidden"
                name="<?= SecurityConstants::CSRF_TOKEN_KEY ?>"
                value="<?= e($csrfService->getOrCreateToken()) ?>">
            <h2>Log In</h2>
            <section>
                <label for="<?= LoginConstants::LOGIN_USERNAME_KEY ?>">Username:</label>
                <input
                    id ="<?= LoginConstants::LOGIN_USERNAME_KEY ?>"
                    type="text"
                    name="<?= LoginConstants::LOGIN_USERNAME_KEY ?>"
                    value="<?= e($login_username) ?>"
                    required
                />
                <div class="<?= PageConstants::MESSAGE_WRAPPER_CLASS ?>">
                    <span class="<?= PageConstants::ERROR_SYMBOL_CLASS ?>">
                        <?= isset($loginErrors->usernameError) ? $loginService->getErrorSymbol() : '' ?>
                    </span>
                    <span id="<?= PageConstants::USERNAME_MESSAGE_ID ?>" class="<?= PageConstants::MESSAGE_CLASS ?>">
                        <?= isset($loginErrors->usernameError) ? e($loginErrors->usernameError) : '' ?>
                    </span>
                </div>
            </section>
            <section>
                <label for="<?= LoginConstants::LOGIN_PASSWORD_KEY ?>">Password:</label>
                <input
                    id="<?= LoginConstants::LOGIN_PASSWORD_KEY ?>"
                    type="password" name="<?= LoginConstants::LOGIN_PASSWORD_KEY ?>"
                    required
                />
                <div class="<?= PageConstants::MESSAGE_WRAPPER_CLASS ?>">
                    <span class="<?= PageConstants::ERROR_SYMBOL_CLASS ?>">
                        <?= isset($loginErrors->passwordError) ? $loginService->getErrorSymbol() : '' ?>
                    </span>
                    <span id="<?= PageConstants::PASSWORD_MESSAGE_ID ?>" class="<?= PageConstants::MESSAGE_CLASS ?>">
                        <?= isset($loginErrors->passwordError) ? e($loginErrors->passwordError) : '' ?>
                    </span>
                </div>
            </section>
            <input id="<?= PageConstants::LOGIN_BUTTON_ID ?>" type="submit" name="<?= LoginConstants::LOGIN_BUTTON_KEY ?>" value="Log In" />
            <p>- or -</p>
            <div class="<?= PageConstants::LINKS_CLASS ?>">
                <a id="<?= PageConstants::CREATE_ACCOUNT_LINK_ID ?>" href="<?= PageConstants::CREATE_ACCOUNT_PAGE ?>">Create an Account</a>
                <a id="<?= PageConstants::HOME_LINK_ID ?>" href="<?= PageConstants::HOME_PAGE ?>">Home</a>
            </div>
        </form>
    </body>
</html>
