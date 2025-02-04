<?php
namespace Project\App\Views\Php\Components\Texts;

class GlobalLink {
    public static function render(string $content, string $url = "/forgotpassword") {
        echo "<a href='" . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . "' 
               class='text-onBackgroundTwo dark:text-darkOnBackgroundTwo CaptionOne hover:underline hover:text-onBackgroundLink dark:hover:text-darkOnBackgroundLink mb-[1px]' 
               aria-label='Link to " . htmlspecialchars($content, ENT_QUOTES, 'UTF-8') . "'>
               " . htmlspecialchars($content, ENT_QUOTES, 'UTF-8') . "
            </a>";
    }
}
?>

