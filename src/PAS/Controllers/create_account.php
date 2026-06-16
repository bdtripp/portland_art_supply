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

$requestHelper = new RequestHelper();
$errorStatus = new stdClass();
$db = new Database();
$userRepo = new UserRepository($db);
$accountDataRepo = new AccountDataRepository($db);
$sessionService = new SessionService($accountDataRepo);
$cartService = new CartService($sessionService);
$loginService = new LoginService($userRepo, $sessionService, $cartService);
$csrfService = new CsrfService($sessionService);

$createUsername = $requestHelper->getPostString(LoginConstants::CREATE_USERNAME_KEY);
$createPassword = $requestHelper->getPostString(LoginConstants::CREATE_PASSWORD_KEY);
$createConfirmPassword = $requestHelper->getPostString(LoginConstants::CREATE_CONFIRM_PASSWORD_KEY);
$createPressed = $requestHelper->isKeySet(LoginConstants::CREATE_ACCOUNT_BUTTON_ID);

if ($createPressed) {
    $csrfService->guard($requestHelper);
    $errorStatus = $loginService->register($createUsername, $createPassword, $createConfirmPassword);
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

            <input type="hidden"
                    name="<?= e(SecurityConstants::CSRF_TOKEN_KEY) ?>"
                    value="<?= e($csrfService->getToken()) ?>">

            <h2>Create an Account</h2>
            <section>
                <label for="<?= e(PageConstants::USERNAME_INPUT_ID) ?>">Username:</label>
                <input
                    id="<?= e(PageConstants::USERNAME_INPUT_ID) ?>"
                    type="text"
                    name="<?= e(LoginConstants::CREATE_USERNAME_KEY) ?>"
                    value="<?= e($createUsername) ?>"
                    required
                />
                <div class="<?= e(PageConstants::MESSAGE_WRAPPER_CLASS) ?>">
                    <span class="<?= e(PageConstants::ERROR_SYMBOL_CLASS) ?>">
                        <?= isset($errorStatus->usernameError) ? e($loginService->showErrorSymbol()) : '' ?>
                    </span>
                    <span id="<?= e(PageConstants::USERNAME_MESSAGE_ID) ?>" class="<?= e(PageConstants::MESSAGE_CLASS) ?>">
                        <?= isset($errorStatus->usernameError) ? e($errorStatus->usernameError) : '' ?>
                    </span>
                </div>
            </section>
            <section id="<?= e(PageConstants::PASSWORD_SECTION_CLASS) ?>">
                <div class="<?= e(PageConstants::WRAPPER_CLASS) ?>">
                    <label for="<?= e(PageConstants::PASSWORD_INPUT_ID) ?>">Password:</label>
                    <input
                        id="<?= e(PageConstants::PASSWORD_INPUT_ID) ?>"
                        type="password" name="<?= e(LoginConstants::CREATE_PASSWORD_KEY) ?>"
                        value="<?= e($createPassword) ?>"
                        required
                    />
                    <div class="<?= e(PageConstants::MESSAGE_WRAPPER_CLASS) ?>">
                        <span class="<?= e(PageConstants::ERROR_SYMBOL_CLASS) ?>">
                            <?= isset($errorStatus->passwordError) ? e($loginService->showErrorSymbol()) : '' ?>
                        </span>
                        <span id="<?= e(PageConstants::PASSWORD_MESSAGE_ID) ?>" class="<?= e(PageConstants::MESSAGE_CLASS) ?>">
                            <?= isset($errorStatus->passwordError) ? e($errorStatus->passwordError) : '' ?>
                        </span>
                    </div>
                </div>
                <p>Password requirements:</p>
                <ul class="<?= e(PageConstants::REQUIREMENTS_CLASS) ?>">
                    <li id="<?= e(PageConstants::UPPERCASE_REQUIREMENT_ID) ?>"><?= e(LoginConstants::PASSWORD_UPPERCASE_REQUIRE) ?></li>
                    <li id="<?= e(PageConstants::DIGIT_REQUIREMENT_ID) ?>"><?= e(LoginConstants::PASSWORD_DIGIT_REQUIRE) ?></li>
                    <li id="<?= e(PageConstants::SPECIAL_CHAR_REQUIREMENT_ID) ?>">
                        <?= e(LoginConstants::PASSWORD_SPECIAL_REQUIRE) ?>
                        <span><?= e(LoginConstants::REQUIRED_SPECIAL_CHARACTERS) ?></span>
                    </li>
                    <li id="<?= e(PageConstants::LENGTH_REQUIREMENT_ID) ?>"><?= e(LoginConstants::PASSWORD_LENGTH_REQUIRE) ?></li>
                </ul>
            </section>
            <section>
                <label for="<?= e(PageConstants::CONFIRM_PASSWORD_INPUT_ID) ?>">Confirm Password:</label>
                <input
                    id="<?= e(PageConstants::CONFIRM_PASSWORD_INPUT_ID) ?>"
                    type="password" name="<?= e(LoginConstants::CREATE_CONFIRM_PASSWORD_KEY) ?>"
                    value="<?= e($createConfirmPassword) ?>"
                    required
                />
                <div class="<?= e(PageConstants::MESSAGE_WRAPPER_CLASS) ?>">
                    <span class="<?= e(PageConstants::ERROR_SYMBOL_CLASS) ?>">
                        <?= isset($errorStatus->confirmPassError) ? e($loginService->showErrorSymbol()) : '' ?>
                    </span>
                    <span id="<?= e(PageConstants::CONFIRM_PASSWORD_MESSAGE_ID) ?>" class="<?= e(PageConstants::MESSAGE_CLASS) ?>">
                        <?= isset($errorStatus->confirmPassError) ? e($errorStatus->confirmPassError) : '' ?>
                    </span>
                </div>
           </section>
            <input
                id="<?= e(LoginConstants::CREATE_ACCOUNT_BUTTON_ID) ?>"
                type="submit"
                name="<?= e(LoginConstants::CREATE_ACCOUNT_BUTTON_ID) ?>"
                value="Create Account"
            />
            <p>- or -</p>
            <div class="<?= e(PageConstants::LINKS_CLASS) ?>">
                <a id="<?= e(PageConstants::LOGIN_LINK_ID) ?>" href="<?= e(PageConstants::LOGIN_PAGE) ?>">Log In</a>
                <a id="<?= e(PageConstants::HOME_LINK_ID) ?>" href="<?= e(PageConstants::HOME_PAGE) ?>">Home</a>
            </div>
        </form>
    </body>
</html>
