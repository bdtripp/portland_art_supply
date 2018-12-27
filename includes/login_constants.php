<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 10/21/2018
 * Time: 11:49 AM
 */

/*
 * Form field names
 */

const LOGIN_USERNAME_KEY = 'login_username';
const LOGIN_PASSWORD_KEY = 'login_password';
const LOGIN_BUTTON_VALUE = 'login';
const CREATE_USERNAME_KEY = 'create_username';
const CREATE_PASSWORD_KEY = 'create_password';
const CREATE_CONFIRM_PASSWORD_KEY = 'create_confirm_password';
const CREATE_BUTTON_VALUE = 'create';

/*
 * Error Messages
 */

const E_LOGIN = 'Error Loggin In!';
const E_REGISTER = 'Error Registering!';


const E_NO_USERNAME = 'Username must be supplied.';
const E_NO_PASSWORD = 'Password must be supplied.';
const E_NO_CONFIRM = 'Password confirmation must be supplied.';
const E_CONFIRM_MISMATCH = 'Password and confirmation must match';
const E_ACCOUNT_EXISTS = 'Username already exists. Please try a different username.';
const E_USERNAME_NOT_FOUND = 'Username does not exist.';
const E_PASSWORD_INCORRECT = 'Password is incorrect.';