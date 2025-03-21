<?php

namespace Project\App\Views\Php\Components\Banners;

use Project\App\Views\Php\Components\Banners\RegularBanner;

class WorkingBanner
{
    public static function render(?string $className = null): void
    {
        $serviceUnavailable = $_SESSION['server_error']['error'] ?? '';
        $errorMessageChangePassword = $_SESSION['error_message']['error'] ?? '';
        $tooManyAttempts = isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 5;
        $success = isset($_SESSION['message']['message']);
        $messageSuccess = isset($_SESSION['success_message']['success_message']);
        $appointmentError = isset($_SESSION['therapistError']['therapistError']);
        if ($tooManyAttempts) {
            http_response_code(429);
            RegularBanner::render(
            "Account Error", 
            "Too many attempts. Please wait 5 minutes before trying again", 
            "alertBig", 
            "destructive",
            "darkDestructive");
        }
        if ($serviceUnavailable) {
            RegularBanner::render(
                "Server Error",
                "Something went wrong on our end. Please try again later.",
                "alertBig",
                "destructive",
                "darkDestructive"
            );
            unset($_SESSION['server_error']);
        }
        if ($success) {
            RegularBanner::render(
                "Success",
                "{$_SESSION['message']['message']}.",
                "alertBig",
                "destructive",
                "darkDestructive"
            );
            unset($_SESSION['message']);
        }
        if ($messageSuccess) {
            RegularBanner::render(
                "Error",
                "{$_SESSION['success_message']['success_message']}.",
                "alertBig",
                "destructive",
                "darkDestructive"
            );
            unset($_SESSION['success_message']);
        }
        if ($errorMessageChangePassword) {
            RegularBanner::render(
                "Success",
                "{$_SESSION['error_message']['error']}.",
                "alertBig",
                "destructive",
                "darkDestructive"
            );
            unset($_SESSION['success_message']);
        }

        if ($appointmentError) {
            RegularBanner::render(
                "Busy",
                "{$_SESSION['therapistError']['therapistError']}.",
                "alertBig",
                "destructive",
                "darkDestructive");
                unset($_SESSION['therapistError']);
        }
    }
}