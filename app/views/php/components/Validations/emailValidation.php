<?php


/**
 * Validates an email address.
 * Returns an error message if the validation fails, otherwise returns an empty string.
 *
 * @param string $email The email address to validate.
 * @return string Error message if validation fails, otherwise an empty string.
 */
function validateEmail($email) {
    if (empty($email)) {
        return "Email is required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid Email Format";
    }

    return ""; 
}

?>
