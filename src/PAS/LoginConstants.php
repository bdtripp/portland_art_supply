<?php
declare(strict_types=1);
namespace PAS;

class LoginConstants
{
    /*
    * Form field names
    */

    public const string LOGIN_USERNAME_KEY = 'login_username';
    public const string LOGIN_PASSWORD_KEY = 'login_password';
    public const string LOGIN_BUTTON_KEY = 'login';
    public const string CREATE_USERNAME_KEY = 'create_username';
    public const string CREATE_PASSWORD_KEY = 'create_password';
    public const string CREATE_CONFIRM_PASSWORD_KEY = 'create_confirm_password';
    public const string CREATE_ACCOUNT_BUTTON_ID = 'create_account_btn';

    /*
    * Input Requirements
    */

    public const string REQUIRED_SPECIAL_CHARACTERS = "!@#$%^&*~+=";
    public const int PASSWORD_MIN_LENGTH = 8;
    public const string PASSWORD_UPPERCASE_REQUIRE = 'At least 1 uppercase character.';
    public const string PASSWORD_DIGIT_REQUIRE = 'At least 1 digit.';
    public const string PASSWORD_SPECIAL_REQUIRE = 'At least 1 of the following:';
    public const string PASSWORD_LENGTH_REQUIRE = 'At least ' . self::PASSWORD_MIN_LENGTH . ' characters long.';

    /*
    * Error Messages
    */

    // server-side

    // delete the following two after fixing login page
    public const string E_LOGIN = 'Error Logging In!';
    public const string E_REGISTER = 'Error Registering!';

    public const string E_NO_USERNAME = 'Username must be supplied.';
    public const string E_NO_PASSWORD = 'Password must be supplied.';
    public const string E_NO_CONFIRM = 'Password confirmation must be supplied.';
    public const string E_CONFIRM_MISMATCH = 'Password and confirmation must match';
    public const string E_ACCOUNT_EXISTS = 'Username already exists. Please try a different username.';
    public const string E_USERNAME_NOT_FOUND = 'Username does not exist.';
    public const string E_PASSWORD_INCORRECT = 'Password is incorrect.';

    // client-side

    public const string E_USERNAME_INVALID_CHARACTER = 'Username can only contain alpha-numeric characters.';
    public const string E_CONFIRM_NOT_MATCH = 'Confirmation password does not match.';
}
