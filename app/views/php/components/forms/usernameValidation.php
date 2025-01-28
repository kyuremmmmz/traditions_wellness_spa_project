<?php

/**
 * Validates a username.
 * Returns "Invalid username or password." if the validation fails, to obscure the specific error for security reasons.
 *
 * @param string $username The username to validate.
 * @return string Error message if validation fails, otherwise an empty string.
 */
function validateUsername($username) {
    if (empty($username)) {
        return "Username required";
    }

    if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        return "Invalid Username or Password";
    }

    return "";
}

?>
