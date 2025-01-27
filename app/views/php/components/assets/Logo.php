<?php

class Logo {
    /**
     * Render the logo component as an inline SVG
     * @param string $class - Additional CSS classes (optional)
     */
    public static function render($class = "") {
        echo '
        <div class="logo-container ' . htmlspecialchars($class) . '">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 width="182" height="182" 
                 viewBox="0 0 182 182" 
                 fill="none">
                <circle cx="91" cy="91" r="91" fill="#0F172A"/>
            </svg>
        </div>';
    }
}
?>
