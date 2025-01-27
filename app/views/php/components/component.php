<?php

class Component {
    /**
     * Render an input field with a floating label
     * @param string $type - Input type (text, password, email, etc.)
     * @param string $name - Name attribute for the input field
     * @param string $label - Label text
     * @param string $value - Default value (optional)
     * @param string $placeholder - Placeholder text (optional)
     */
    public static function inputField($type = "text", $name = "input", $label = "Enter Text", $value = "", $placeholder = " ") {
        $id = "input_" . $name; // Unique ID for each input field

        echo '
        <div class="input-group">
            <input type="' . htmlspecialchars($type) . '" 
                   name="' . htmlspecialchars($name) . '" 
                   id="' . $id . '"
                   value="' . htmlspecialchars($value) . '" 
                   placeholder="' . htmlspecialchars($placeholder) . '" 
                   required>
            <label for="' . $id . '">' . htmlspecialchars($label) . '</label>
        </div>';
    }

    /**
     * Render a password input field with a FontAwesome eye toggle
     * @param string $name - Name attribute for the password field
     * @param string $label - Label text for the password field
     */
    public static function passwordField($name = "password", $label = "Enter Your Password") {
        $id = "input_" . $name; // Unique ID for the password field

        echo '
        <div class="input-group">
            <input type="password" 
                   name="' . htmlspecialchars($name) . '" 
                   id="' . $id . '" 
                   placeholder=" " 
                   required>
            <label for="' . $id . '">' . htmlspecialchars($label) . '</label>
            <button type="button" class="toggle-password" onclick="togglePassword(\'' . $id . '\')">
                <i id="eye-icon-' . $id . '" class="fas fa-eye"></i>
            </button>
        </div>';
    }
}
?>
