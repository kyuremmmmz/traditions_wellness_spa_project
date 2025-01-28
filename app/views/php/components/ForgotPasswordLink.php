<?php
namespace Project\App\Views\Php\Components;

class ForgotPasswordLink {
    private $url;

    // Constructor to initialize the URL to which the forgot password link should point
    public function __construct($url = "/forgot-password") {
        $this->url = $url;
    }

    public function render() {
        echo "
        <div class='text-right mt-2'>
            <a href='" . htmlspecialchars($this->url) . "' 
               class='text-sm text-gray-500 underline hover:text-gray-700' 
               style='font-family: Inter; font-size: 12px; line-height: 18px; letter-spacing: -0.264px;'>
               Forgot password?
            </a>
        </div>
        ";
    }
}
?>
