<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/21/2018
 * Time: 12:02 PM
 */

function save_session() {
    $userID = get_session_value(SESSION_USER_ID_KEY);
    add_session($userID, serialize($_SESSION));
}

function restore_session() {
    $userID = get_session_value(SESSION_USER_ID_KEY);
    $session_data = lookup_session($userID);
    if (!empty($session_data)) {
        $_SESSION = unserialize($session_data[ACCOUNT_DATA_SESSION_DATA_FIELD]);
    }
}

function get_session_value($key) {
    if(isset($_SESSION[$key])) {
        return $_SESSION[$key];
    }
    return;
}

function set_session_value($key, $value) {
    $_SESSION[$key] = $value;
}

function destroy_session() {
    $session_info = session_get_cookie_params();
    $_SESSION = [];
    setcookie(session_name(), '', 0, $session_info['path'], $session_info['domain'],
        $session_info['secure'], $session_info['httponly']);
    session_destroy();
}

function get_post_value($key) {
    if (isset($_POST[$key])) {
        return htmlentities($_POST[$key]);
    }
    return '';
}

function require_login() {
    if (!isset($_SESSION[SESSION_USERNAME_KEY]) || empty($_SESSION[SESSION_USERNAME_KEY])) {
        header('Location: ' . LOGIN_PAGE);
        exit();
    }
    restore_session();
}