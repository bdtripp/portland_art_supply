<?php
declare(strict_types=1);
namespace PAS;

class Utilities
{
    public static function getSessionValue(string $key): mixed {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function saveSession(): void {
        $db = new Database();
        $userID = self::getSessionValue(PageConstants::SESSION_USER_ID_KEY);
        $db->addSession($userID, serialize($_SESSION));
    }

    public static function restoreSession(): void {
        $db = new Database();
        $userID = self::getSessionValue(PageConstants::SESSION_USER_ID_KEY);
        $session_data = $db->lookupSession($userID);

        if (!empty($session_data)) {
            $_SESSION = unserialize($session_data[DbConstants::ACCOUNT_DATA_SESSION_DATA_FIELD]);
        }
    }

    public static function setSessionValue(string $key, mixed $value): void {
        $_SESSION[$key] = $value;
    }

    public static function destroySession(): void {
        $session_info = session_get_cookie_params();
        $_SESSION = [];
        setcookie(session_name(), '', 0, $session_info['path'], $session_info['domain'],
            $session_info['secure'], $session_info['httponly']);
        session_destroy();
    }

    public static function getPostValue(string $key): string {
        if (isset($_POST[$key])) {
            return htmlentities((string) $_POST[$key]);
        }
        return '';
    }

    public static function requireLogin(): void {
        if (!isset($_SESSION[PageConstants::SESSION_USERNAME_KEY]) || empty($_SESSION[PageConstants::SESSION_USERNAME_KEY])) {
            header('Location: ' . PageConstants::LOGIN_PAGE);
            exit();
        }
        self::restoreSession();
    }

    public static function hasMatchingGETValue(string $param, mixed $value): bool {
        return isset($_GET[$param]) && $_GET[$param] === (string) $value;
    }

    public static function checkCurrentSubcat(string $categoryParam, string $categoryValue, string $subcategoryParam, string $subcategoryValue): string {
        if (self::hasMatchingGETValue($categoryParam, $categoryValue) && self::hasMatchingGETValue($subcategoryParam, $subcategoryValue)) {
            return 'aria-current="page"';
        }
        return '';
    }

    public static function checkCurrentPage(string $url): string {
        if ($_SERVER['REQUEST_URI'] === $url) {
            return 'aria-current="page" href="#">';
        }
        return 'href="' . $url . '">';
    }

    /**
     * @return array<int, CartItem>
     */
    public static function getCartItems(): array {
        $items = self::getSessionValue(PageConstants::SESSION_CART_KEY);

        if (!is_array($items)) {
            return [];
        }

        return array_values(
            array_filter($items, fn($i) => $i instanceof CartItem)
        );
    }

    /**
     * @param array<int, CartItem> $items
     */
    public static function setCartItems(array $items): void {
        self::setSessionValue(PageConstants::SESSION_CART_KEY, $items);
        self::saveSession();
    }
}