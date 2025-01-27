
<?php

class MiniLogo {
    /**
     * Render the Mini Logo component
     * @param string $class - Additional CSS classes (optional)
     */
    public static function render($class = "") {
        echo '
        <div class="mini-logo ' . htmlspecialchars($class) . '"></div>';
    }
}
?>
