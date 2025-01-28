<?php

/**
 * Validates a phone number.
 * Returns an error message if the validation fails, otherwise returns an empty string.
 *
 * @param string $phoneNumber The phone number to validate.
 * @return string Error message if validation fails, otherwise an empty string.
 */
function validatePhoneNumber($phoneNumber) {
    // Strip out non-numeric characters for validation
    $cleaned = preg_replace('/[^0-9]/', '', $phoneNumber);

    // Check the length of the phone number (assuming US/Canada-like numbers, 10 digits)
    if (strlen($cleaned) != 10) {
        return "Please enter a valid number.";
    }

    return ""; 
}

?>
