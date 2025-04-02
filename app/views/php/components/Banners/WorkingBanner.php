<?php

namespace Project\App\Views\Php\Components\Banners;

use Project\App\Views\Php\Components\Banners\RegularBanner;

class WorkingBanner
{
    public static function render(?string $className = null): void
    {
        $serviceUnavailable = $_SESSION['server_error']['error'] ?? '';
        $errorMessageChangePassword = $_SESSION['error_message']['error_message'] ?? '';
        $tooManyAttempts = isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 5;
        $success = isset($_SESSION['message']['message']);
        $messageSuccess = isset($_SESSION['success_message']['success_message']);
        $appointmentError = isset($_SESSION['therapistError']['therapistError']);
        $serviceMessage = isset($_SESSION['service_message']);
        $sumakses = isset($_SESSION['sumakses']['sumakses']);
        if ($tooManyAttempts) {
            http_response_code(429);
            RegularBanner::render(
            "Account Error", 
            "Too many attempts. Please wait 5 minutes before trying again", 
            "alertBig", 
            "destructive",
            "darkDestructive");
        }

        if ($serviceMessage) {
            http_response_code(200);
            RegularBanner::render(
                "Success",
                "{$_SESSION['service_message']}",
                "alertBig",
                "destructive",
                "darkDestructive"
            );
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
                "Success",
                "{$_SESSION['success_message']['success_message']}.",
                "alertBig",
                "destructive",
                "darkDestructive"
            );
            unset($_SESSION['success_message']);
        }
        if ($errorMessageChangePassword) {
            RegularBanner::render(
                "Error",
                "{$_SESSION['error_message']['error_message']}.",
                "alertBig",
                "destructive",
                "darkDestructive"
            );
            unset($_SESSION['error_message']);
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
        if ($sumakses) {
            RegularBanner::render(
                "Success",
                "{$_SESSION['sumakses']['sumakses']}.",
                "alertBig",
                "destructive",
                "darkDestructive"
            );
            unset($_SESSION['sumakses']['sumakses']);
        }
    }
}