<?php
require_once __DIR__ . '/../../../config.php';

use PAS\Config\LoginConstants;
use PAS\Services\CartService;
use PAS\Services\LoginService;
use PAS\Infrastructure\Database;
use PAS\Config\PageConstants;
use PAS\Config\SecurityConstants;
use PAS\Services\SessionService;
use PAS\Services\CsrfService;
use PAS\Repositories\UserRepository;
use PAS\Repositories\AccountDataRepository;
use PAS\Support\RequestHelper;

$registrationErrors = null;

$db = new Database();
$userRepository = new UserRepository($db);
$accountDataRepository = new AccountDataRepository($db);

$sessionService = new SessionService($accountDataRepository);
$cartService = new CartService($sessionService);
$loginService = new LoginService($userRepository, $sessionService, $cartService);
$csrfService = new CsrfService($sessionService);

$requestHelper = new RequestHelper();

$createUsername = $requestHelper->getPostString(LoginConstants::CREATE_USERNAME_KEY);
$createPassword = $requestHelper->getPostString(LoginConstants::CREATE_PASSWORD_KEY);
$createConfirmPassword = $requestHelper->getPostString(LoginConstants::CREATE_CONFIRM_PASSWORD_KEY);
$createPressed = $requestHelper->isKeySet(LoginConstants::CREATE_ACCOUNT_BUTTON_ID);

if ($createPressed) {
    $csrfService->guard($requestHelper);
    $registrationErrors = $loginService->register($createUsername, $createPassword, $createConfirmPassword);
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
        <link href="css/reset.css" rel="stylesheet">
        <link href="css/login.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <script src="js/create_account.js.php"></script>

    </head>
    <body>
        <form method="POST" action="create_account.php" onsubmit="return checkIfValid();">

            <input type="hidden"
                    name="<?= SecurityConstants::CSRF_TOKEN_KEY ?>"
                    value="<?= e($csrfService->getToken()) ?>">

            <h2>Create an Account</h2>
            <section>
                <label for="<?= PageConstants::USERNAME_INPUT_ID ?>">Username:</label>
                <input
                    id="<?= PageConstants::USERNAME_INPUT_ID ?>"
                    type="text"
                    name="<?= LoginConstants::CREATE_USERNAME_KEY ?>"
                    value="<?= e($createUsername) ?>"
                    required
                />
                <div class="<?= PageConstants::MESSAGE_WRAPPER_CLASS ?>">
                    <span class="<?= PageConstants::ERROR_SYMBOL_CLASS ?>">
                        <?= isset($registrationErrors->usernameError) ? $loginService->showErrorSymbol() : '' ?>
                    </span>
                    <span id="<?= PageConstants::USERNAME_MESSAGE_ID ?>" class="<?= PageConstants::MESSAGE_CLASS ?>">
                        <?= isset($registrationErrors->usernameError) ? e($registrationErrors->usernameError) : '' ?>
                    </span>
                </div>
            </section>
            <section id="<?= PageConstants::PASSWORD_SECTION_CLASS ?>">
                <div class="<?= PageConstants::WRAPPER_CLASS ?>">
                    <label for="<?= PageConstants::PASSWORD_INPUT_ID ?>">Password:</label>
                    <input
                        id="<?= PageConstants::PASSWORD_INPUT_ID ?>"
                        type="password" name="<?= LoginConstants::CREATE_PASSWORD_KEY ?>"
                        required
                    />
                    <div class="<?= PageConstants::MESSAGE_WRAPPER_CLASS ?>">
                        <span class="<?= PageConstants::ERROR_SYMBOL_CLASS ?>">
                            <?= isset($registrationErrors->passwordError) ? $loginService->showErrorSymbol() : '' ?>
                        </span>
                        <span id="<?= PageConstants::PASSWORD_MESSAGE_ID ?>" class="<?= PageConstants::MESSAGE_CLASS ?>">
                            <?= isset($registrationErrors->passwordError) ? e($registrationErrors->passwordError) : '' ?>
                        </span>
                    </div>
                </div>
                <p>Password requirements:</p>
                <ul class="<?= PageConstants::REQUIREMENTS_CLASS ?>">
                    <li id="<?= PageConstants::UPPERCASE_REQUIREMENT_ID ?>"><?= LoginConstants::PASSWORD_UPPERCASE_REQUIRE ?></li>
                    <li id="<?= PageConstants::DIGIT_REQUIREMENT_ID ?>"><?= LoginConstants::PASSWORD_DIGIT_REQUIRE ?></li>
                    <li id="<?= PageConstants::SPECIAL_CHAR_REQUIREMENT_ID ?>">
                        <?= LoginConstants::PASSWORD_SPECIAL_REQUIRE ?>
                        <span><?= LoginConstants::REQUIRED_SPECIAL_CHARACTERS ?></span>
                    </li>
                    <li id="<?= PageConstants::LENGTH_REQUIREMENT_ID ?>"><?= LoginConstants::PASSWORD_LENGTH_REQUIRE ?></li>
                </ul>
            </section>
            <section>
                <label for="<?= PageConstants::CONFIRM_PASSWORD_INPUT_ID ?>">Confirm Password:</label>
                <input
                    id="<?= PageConstants::CONFIRM_PASSWORD_INPUT_ID ?>"
                    type="password" name="<?= LoginConstants::CREATE_CONFIRM_PASSWORD_KEY ?>"
                    required
                />
                <div class="<?= PageConstants::MESSAGE_WRAPPER_CLASS ?>">
                    <span class="<?= PageConstants::ERROR_SYMBOL_CLASS ?>">
                        <?= isset($registrationErrors->confirmPassError) ? $loginService->showErrorSymbol() : '' ?>
                    </span>
                    <span id="<?= PageConstants::CONFIRM_PASSWORD_MESSAGE_ID ?>" class="<?= PageConstants::MESSAGE_CLASS ?>">
                        <?= isset($registrationErrors->confirmPassError) ? e($registrationErrors->confirmPassError) : '' ?>
                    </span>
                </div>
           </section>
            <input
                id="<?= LoginConstants::CREATE_ACCOUNT_BUTTON_ID ?>"
                type="submit"
                name="<?= LoginConstants::CREATE_ACCOUNT_BUTTON_ID ?>"
                value="Create Account"
            />
            <p>- or -</p>
            <div class="<?= PageConstants::LINKS_CLASS ?>">
                <a id="<?= PageConstants::LOGIN_LINK_ID ?>" href="<?= PageConstants::LOGIN_PAGE ?>">Log In</a>
                <a id="<?= PageConstants::HOME_LINK_ID ?>" href="<?= PageConstants::HOME_PAGE ?>">Home</a>
            </div>
        </form>
    </body>
</html>
