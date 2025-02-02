<?php
namespace Project\App\Views\Php\Components;

class ForgotPasswordLink {
    private $url;

    // Constructor to initialize the URL to which the forgot password link should point
    public function __construct($url = "/forgotpassword") {
        $this->url = $url;
    }

    public function render() {
        echo "
        <div class='text-right mt-2'>
            <a href='" . htmlspecialchars($this->url) . "' 
               class='text-sm text-gray-500 underline hover:text-gray-700' >
               Forgot password?
            </a>
        </div>
        ";
    }
}
?>
