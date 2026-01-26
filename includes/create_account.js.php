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

const REQUIRED_SPECIAL_CHARACTERS = "!@#$%^&*~+=";
const PASSWORD_MIN_LENGTH = 8;
const USERNAME_INPUT_ID = '<?php echo USERNAME_INPUT_ID; ?>';
const PASSWORD_INPUT_ID = '<?php echo PASSWORD_INPUT_ID; ?>';
const CONFIRM_PASSWORD_INPUT_ID = '<?php echo CONFIRM_PASSWORD_INPUT_ID; ?>';
const PASSWORD_MESSAGE_ID = '<?php echo PASSWORD_MESSAGE_ID ?>';
const USERNAME_MESSAGE_ID = '<?php echo USERNAME_MESSAGE_ID ?>';
const CONFIRM_PASSWORD_MESSAGE_ID = '<?php echo CONFIRM_PASSWORD_MESSAGE_ID ?>';
const USERNAME_INVALID_CHARACTER_ERROR = 'Username can only contain alpha-numeric characters.';
const CONFIRM_NOT_MATCH_ERROR = 'Confirmation password doesn\'t match.';
const UPPERCASE_REQUIREMENT_ID = '<?php echo UPPERCASE_REQUIREMENT_ID; ?>';
const DIGIT_REQUIREMENT_ID = '<?php echo DIGIT_REQUIREMENT_ID; ?>';
const SPECIAL_CHAR_REQUIREMENT_ID = '<?php echo SPECIAL_CHAR_REQUIREMENT_ID; ?>';
const LENGTH_REQUIREMENT_ID = '<?php echo LENGTH_REQUIREMENT_ID; ?>';
const REQUIREMENTS_CLASS = '<?php echo REQUIREMENTS_CLASS; ?>';
const MEETS_REQUIREMENTS_CLASS = '<?php echo MEETS_REQUIREMENTS_CLASS; ?>';
const STILL_NEEDED_CLASS = '<?php echo STILL_NEEDED_CLASS; ?>';
const ERROR_SYMBOL_CLASS = '<?php echo ERROR_SYMBOL_CLASS; ?>';


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

function isValidLength(input) {
    if (input.length < PASSWORD_MIN_LENGTH) {
        return false;
    } else {
        return true;
    }
}

function setErrorMessage(id, message) {
    let messageSpan = document.getElementById(id)
    let symbolSpan = messageSpan.previousElementSibling;

    symbolSpan.innerText = "⚠ ";
    messageSpan.innerText = message;
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
    let meetsLength = false;
    let uppercaseRequirement = document.getElementById(UPPERCASE_REQUIREMENT_ID);
    let digitRequirement = document.getElementById(DIGIT_REQUIREMENT_ID);
    let specialCharRequirement = document.getElementById(SPECIAL_CHAR_REQUIREMENT_ID);
    let lengthRequirement = document.getElementById(LENGTH_REQUIREMENT_ID);

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
        if (isValidLength(input)) {
            meetsLength = true;
        }
    }

    hasUpper ? markOffRequirement(uppercaseRequirement) : showRequirementNeeded(uppercaseRequirement);
    hasDigit ? markOffRequirement(digitRequirement) : showRequirementNeeded(digitRequirement);
    hasSpecial ? markOffRequirement(specialCharRequirement) : showRequirementNeeded(specialCharRequirement);
    meetsLength ? markOffRequirement(lengthRequirement) : showRequirementNeeded(lengthRequirement);

    if (hasUpper && hasDigit && hasSpecial && meetsLength) {
        return true;
    } else {
        return false;
    }
}

function markOffRequirement(requirement) {
    requirement.classList.remove(STILL_NEEDED_CLASS);
    requirement.classList.add(MEETS_REQUIREMENTS_CLASS);
}

// puts requirement list item back to the default style after they delete a character that had previously met a requirement
function showRequirementNeeded(requirement) {
    requirement.classList.remove(MEETS_REQUIREMENTS_CLASS);
}

// add more emphasis to the particular requirement that is still needed after the user tries to submit the form
function markAsStillNeeded() {
    let requirements = document.getElementsByClassName(REQUIREMENTS_CLASS)[0].children;

    [...requirements].map(requirement => {
        if (!requirement.classList.contains(MEETS_REQUIREMENTS_CLASS)) {
            requirement.classList.add(STILL_NEEDED_CLASS);
        }
    });
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

function checkIfValidPassword(submitClicked) {
    let input = getValue(PASSWORD_INPUT_ID);

    let meetsRequirements = checkPasswordRequirements(input);

    if (submitClicked && !meetsRequirements) {
        markAsStillNeeded();
    }

    return meetsRequirements;
}

function checkIfValidConfirm() {
    let input = getValue(CONFIRM_PASSWORD_INPUT_ID);

    clearMessage(CONFIRM_PASSWORD_MESSAGE_ID);
    return checkConfirmRequirements(input);
}

function checkIfValid() {
    let isValidPassword = checkIfValidPassword(true);
    let isValidUsername = checkIfValidUsername();
    let isValidConfirm = checkIfValidConfirm();

    return isValidPassword && isValidUsername && isValidConfirm;
}

window.addEventListener("load", function() {
   document.getElementById(PASSWORD_INPUT_ID).addEventListener("input", () => checkIfValidPassword(false));
   document.getElementById(USERNAME_INPUT_ID).addEventListener("input", checkIfValidUsername);
});
