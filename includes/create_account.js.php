<?php
/**
 * Created by PhpStorm.
 * User: Brian
 * Date: 12/10/2018
 * Time: 3:42 PM
 */
header('Content-Type: text/javascript');

require_once('page_constants.php');
?>

var REQUIRED_SPECIAL_CHARACTERS = "!@#$%^&*~+=";
var PASSWORD_MIN_LENGTH = 8;
var USERNAME_INPUT_ID = '<?php echo USERNAME_INPUT_ID; ?>';
var PASSWORD_INPUT_ID = '<?php echo PASSWORD_INPUT_ID; ?>';
var CONFIRM_PASSWORD_INPUT_ID = '<?php echo CONFIRM_PASSWORD_INPUT_ID; ?>';
var PASSWORD_MESSAGE_ID = '<?php echo PASSWORD_MESSAGE_ID ?>';
var USERNAME_MESSAGE_ID = '<?php echo USERNAME_MESSAGE_ID ?>';
var CONFIRM_PASSWORD_MESSAGE_ID = '<?php echo CONFIRM_PASSWORD_MESSAGE_ID ?>';
var PASSWORD_UPPERCASE_ERROR = 'Password must contain at least 1 uppercase character.';
var PASSWORD_DIGIT_ERROR = 'Password must contain at least 1 digit.';
var PASSWORD_SPECIAL_ERROR = 'Password must contain at least 1 of the following:\n' + REQUIRED_SPECIAL_CHARACTERS;
var PASSWORD_LENGTH_ERROR = 'Password must be at least ' + PASSWORD_MIN_LENGTH + ' characters long.';
var USERNAME_INVALID_CHARACTER_ERROR = 'Username can only contain alpha-numeric characters.';
var CONFIRM_NOT_MATCH_ERROR = 'Confirmation password doesn\'t match.';

function isUpper(character) {
    return character >= 'A' && character <= 'Z';
}

function isLower(character) {
    return character >= 'a' && character <= 'z';
}

function isDigit(character) {
    return character >= 0 && character <= 9;
}

function isSpecial(character) {
    return REQUIRED_SPECIAL_CHARACTERS.indexOf(character) >= 0;
}

function getValue(id) {
    return document.getElementById(id).value;
}

function clearMessage(id) {
    document.getElementById(id).innerText = '';
}

function checkIfValidLength(input) {
    if (input.length < PASSWORD_MIN_LENGTH) {
        setErrorMessage(PASSWORD_MESSAGE_ID, PASSWORD_LENGTH_ERROR)
        return false;
    } else {
        return true;
    }
}

function setErrorMessage(id, message) {
    document.getElementById(id).innerText = message;
}

function checkUsernameRequirements(input) {
    let meetsRequirements = true;

    for (count = 0; count < input.length; count++) {
        if (!isLower(input.charAt(count)) && !isUpper(input.charAt(count)) && !isDigit(input.charAt(count))) {
            setErrorMessage(USERNAME_MESSAGE_ID, USERNAME_INVALID_CHARACTER_ERROR);
            meetsRequirements = false;
        }
    }
    return meetsRequirements;
}

function checkPasswordRequirements(input) {
    let hasUpper = false;
    let hasDigit = false;
    let hasSpecial = false;

    for (count = 0; count < input.length; count++) {
        if (isUpper(input.charAt(count))) {
            hasUpper = true;
        }
        if (isDigit(input.charAt(count))) {
            hasDigit = true;
        }
        if (isSpecial(input.charAt(count))) {
            hasSpecial = true;
        }
    }

    if (!hasUpper) {
        setErrorMessage(PASSWORD_MESSAGE_ID, PASSWORD_UPPERCASE_ERROR);
    } else if (!hasDigit) {
        setErrorMessage(PASSWORD_MESSAGE_ID, PASSWORD_DIGIT_ERROR);
    } else if (!hasSpecial) {
        setErrorMessage(PASSWORD_MESSAGE_ID, PASSWORD_SPECIAL_ERROR);
    }

    if (hasUpper && hasDigit && hasSpecial) {
        return true;
    } else {
        return false;
    }
}

function checkConfirmRequirements(input) {
    let password = getValue(PASSWORD_INPUT_ID);

    if (password !== input) {
        setErrorMessage(CONFIRM_PASSWORD_MESSAGE_ID, CONFIRM_NOT_MATCH_ERROR);
        return false;
    } else {
        return true;
    }
}

function checkIfValidUsername() {
    let input = getValue(USERNAME_INPUT_ID);

    clearMessage(USERNAME_MESSAGE_ID);
    return checkUsernameRequirements(input);
}

function checkIfValidPassword() {
    let input = getValue(PASSWORD_INPUT_ID);

    clearMessage(PASSWORD_MESSAGE_ID);
    let validLength = checkIfValidLength(input);
    let meetsRequirements = checkPasswordRequirements(input);

    return validLength && meetsRequirements;
}

function checkIfValidConfirm() {
    let input = getValue(CONFIRM_PASSWORD_INPUT_ID);

    clearMessage(CONFIRM_PASSWORD_MESSAGE_ID);
    return checkConfirmRequirements(input);
}

function checkIfValid() {
    let isValidPassword = checkIfValidPassword();
    let isValidUsername = checkIfValidUsername();
    let isValidConfirm = checkIfValidConfirm();

    return isValidPassword && isValidUsername && isValidConfirm;
}

window.addEventListener("load", function() {
   document.getElementById(PASSWORD_INPUT_ID).addEventListener("input", checkIfValidPassword);
   document.getElementById(USERNAME_INPUT_ID).addEventListener("input", checkIfValidUsername);
});
