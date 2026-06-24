<?php

/**
 * Constants used by the login and account‑creation workflows.
 *
 * These values include request keys, password requirements, and both
 * server‑side and client‑side validation error messages.
 */

declare(strict_types=1);

namespace PAS\Config;

class LoginConstants
{
    /*
    * Request keys used by the login and account creation workflows.
    */

    public const LOGIN_USERNAME_KEY = 'login_username';
    public const LOGIN_PASSWORD_KEY = 'login_password';
    public const LOGIN_BUTTON_KEY = 'login';
    public const CREATE_USERNAME_KEY = 'create_username';
    public const CREATE_PASSWORD_KEY = 'create_password';
    public const CREATE_CONFIRM_PASSWORD_KEY = 'create_confirm_password';
    public const CREATE_ACCOUNT_BUTTON_ID = 'create_account_btn';

    /*
    * Input Requirements
    */

    public const REQUIRED_SPECIAL_CHARACTERS = "!@#$%^&*~+=";
    public const int PASSWORD_MIN_LENGTH = 8;
    public const PASSWORD_UPPERCASE_REQUIRE = 'At least 1 uppercase character.';
    public const PASSWORD_DIGIT_REQUIRE = 'At least 1 digit.';
    public const PASSWORD_SPECIAL_REQUIRE = 'At least 1 of the following:';
    public const PASSWORD_LENGTH_REQUIRE = 'At least ' . self::PASSWORD_MIN_LENGTH . ' characters long.';

    /*
    * Error Messages
    */

    // server-side

    // delete the following two after fixing login page
    public const E_LOGIN = 'Error Logging In!';
    public const E_REGISTER = 'Error Registering!';

    public const E_NO_USERNAME = 'Username must be supplied.';
    public const E_NO_PASSWORD = 'Password must be supplied.';
    public const E_NO_CONFIRM = 'Password confirmation must be supplied.';
    public const E_CONFIRM_MISMATCH = 'Password and confirmation must match';
    public const E_ACCOUNT_EXISTS = 'Username already exists. Please try a different username.';
    public const E_USERNAME_NOT_FOUND = 'Username does not exist.';
    public const E_PASSWORD_INCORRECT = 'Password is incorrect.';

    // client-side

    public const E_USERNAME_INVALID_CHARACTER = 'Username can only contain alpha-numeric characters.';
    public const E_CONFIRM_NOT_MATCH = 'Confirmation password does not match.';
}
