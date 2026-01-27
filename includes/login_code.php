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
    $errorStatus = new stdClass();

    if (empty($username)) {
        $errorStatus->usernameError = E_NO_USERNAME;
    }

    if (empty($password)) {
        $errorStatus->passwordError = E_NO_PASSWORD;
    }

    if (empty($confirm)) {
        $errorStatus->confirmPassError = E_NO_CONFIRM;
    }

    if ($password != $confirm) {
        $errorStatus->confrimPassError = E_CONFIRM_MISMATCH;
    }

    $user = lookup_user($username);

    if (!empty($user)) {
        $errorStatus->usernameError = E_ACCOUNT_EXISTS;
    }

    // if there are any errors, return without loggin in
    if (!empty((array)$errorStatus)) {
        return $errorStatus;
    }

    add_user($username, password_hash($password, PASSWORD_DEFAULT));
    $user = lookup_user($username);
    set_user($user[USER_ID_FIELD], $username, $returnToUrl);
}