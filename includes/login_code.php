<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/21/2018
 * Time: 4:36 PM
 */

function error_message($type, $detail) {
    return '<div id="' . ERROR_MESSAGE_CONTAINER . '">
                <div id="error_header">' . $type . '</div>
                <div id="error_detail">' . $detail . '</div>
            </div>';
}

function set_user($userID, $username, $returnToUrl) {
    set_session_value(SESSION_USER_ID_KEY, $userID);
    set_session_value(SESSION_USERNAME_KEY, $username);
    header('Location: ' . $returnToUrl);
}

function login($username, $password, $returnToUrl) {
    if (empty($username)) {
        return error_message(E_LOGIN, E_NO_USERNAME);
    }

    if (empty($password)) {
        return error_message(E_LOGIN, E_NO_PASSWORD);
    }

    $user = lookup_user($username);

    if (!$user) {
        return error_message(E_LOGIN, E_USERNAME_NOT_FOUND);
    }

    if (!password_verify($password, $user[USERS_HASH_FIELD])) {
        return error_message(E_LOGIN, E_PASSWORD_INCORRECT);
    }

    set_user($user[USER_ID_FIELD], $username, $returnToUrl);
    restore_session();
    return '';
}

function register($username, $password, $confirm, $returnToUrl) {
    if (empty($username)) {
        return error_message(E_REGISTER, E_NO_USERNAME);
    }

    if (empty($password)) {
        return error_message(E_REGISTER, E_NO_PASSWORD);
    }

    if (empty($confirm)) {
        return error_message(E_REGISTER, E_NO_CONFIRM);
    }

    if ($password != $confirm) {
        return error_message(E_REGISTER, E_CONFIRM_MISMATCH);
    }

    $user = lookup_user($username);

    if (!empty($user)) {
        return error_message(E_REGISTER, E_ACCOUNT_EXISTS);
    }

    add_user($username, password_hash($password, PASSWORD_DEFAULT));
    $user = lookup_user($username);
    set_user($user[USER_ID_FIELD], $username, $returnToUrl);
}