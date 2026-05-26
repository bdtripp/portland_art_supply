<?php
namespace PAS;

class Utilities
{
    public static function getSessionValue($key) {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return;
    }
    public static function saveSession() {
        $db = new Database();
        $userID = self::getSessionValue(PageConstants::SESSION_USER_ID_KEY);
        $db->addSession($userID, serialize($_SESSION));
    }

    public static function restoreSession() {
        $db = new Database();
        $userID = self::getSessionValue(PageConstants::SESSION_USER_ID_KEY);
        $session_data = $db->lookupSession($userID);

        if (!empty($session_data)) {
            $_SESSION = unserialize($session_data[DbConstants::ACCOUNT_DATA_SESSION_DATA_FIELD]);
        }
    }

    public static function setSessionValue($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function destroySession() {
        $session_info = session_get_cookie_params();
        $_SESSION = [];
        setcookie(session_name(), '', 0, $session_info['path'], $session_info['domain'],
            $session_info['secure'], $session_info['httponly']);
        session_destroy();
    }

    public static function getPostValue($key) {
        if (isset($_POST[$key])) {
            return htmlentities($_POST[$key]);
        }
        return '';
    }

    public static function requireLogin() {
        if (!isset($_SESSION[PageConstants::SESSION_USERNAME_KEY]) || empty($_SESSION[PageConstants::SESSION_USERNAME_KEY])) {
            header('Location: ' . PageConstants::LOGIN_PAGE);
            exit();
        }
        self::restoreSession();
    }

    public static function hasMatchingGETValue($param, $value) {
        return isset($_GET[$param]) && $_GET[$param] === $value;
    }

    public static function checkCurrentSubcat($categoryParam, $categoryValue, $subcategoryParam, $subcategoryValue) {
        if (self::hasMatchingGETValue($categoryParam, $categoryValue) && self::hasMatchingGETValue($subcategoryParam, $subcategoryValue)) {
            return 'aria-current="page"';
        }
        return '';
    }

    public static function checkCurrentPage($url) {
        if ($_SERVER['REQUEST_URI'] === $url) {
            return 'aria-current="page" href="#">';
        }
        return 'href="' . $url . '">';
    }
}