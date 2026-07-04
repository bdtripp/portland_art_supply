<?php

/**
 * Application entry point and front controller.
 *
 * All HTTP requests enter the system through this file. It resolves the
 * request path and dispatches execution to the appropriate handler. The
 * routing logic is intentionally simple and will evolve into a dedicated
 * Router and Controller layer as the architecture matures.
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../helpers.php';
session_start();

use PAS\Config\PageConstants;
use PAS\Exceptions\CsrfException;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

try {
    switch ($uri) {
        case PageConstants::HOME_PAGE:
            require __DIR__ . '/../src/PAS/Controllers/home.php';
            break;

        case PageConstants::ABOUT_PAGE:
            require __DIR__ . '/../src/PAS/Controllers/about.php';
            break;

        case PageConstants::CREATE_ACCOUNT_PAGE:
            require __DIR__ . '/../src/PAS/Controllers/create_account.php';
            break;

        case PageConstants::LOGIN_PAGE:
            require __DIR__ . '/../src/PAS/Controllers/login.php';
            break;

        case PageConstants::LOGOUT_PAGE:
            require __DIR__ . '/../src/PAS/Controllers/logout.php';
            break;

        case PageConstants::GROUP_PRODUCTS_PAGE:
            require __DIR__ . '/../src/PAS/Controllers/product_groups.php';
            break;

        case PageConstants::PRODUCT_ITEMS_PAGE:
            require __DIR__ . '/../src/PAS/Controllers/product_items.php';
            break;

        case PageConstants::SHOPPING_CART_PAGE:
            require __DIR__ . '/../src/PAS/Controllers/shopping_cart.php';
            break;

        default:
            http_response_code(404);
            echo 'Page not found';
            exit;
    }
} catch (CsrfException $e) {
    http_response_code(400);
    echo 'Invalid CSRF token';
    exit;
} catch (\Throwable $e) {
    http_response_code(500);
    echo 'Internal Server Error';
    exit;
}
