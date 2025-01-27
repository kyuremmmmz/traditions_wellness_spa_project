<?php

class RememberMe {
    /**
     * Render the "Remember Me" checkbox
     * @param string $name - The name attribute for the checkbox
     * @param bool $checked - Whether the checkbox is checked by default
     */
    public static function render($name = "remember_me", $checked = false) {
        echo '
        <div class="remember-me">
            <input type="checkbox" id="' . htmlspecialchars($name) . '" name="' . htmlspecialchars($name) . '" ' . ($checked ? 'checked' : '') . '>
            <label for="' . htmlspecialchars($name) . '">Remember me</label>
        </div>';
    }
}
?>
