<?php
namespace Project\App\Views\Php\Components\Texts;

class GlobalLink {

    public static function render(string $url = "/forgotpassword", string $content = "") {
        echo "<a href='{$url}' 
               class='text-onBackgroundTwo dark:text-darkOnBackgroundTwo CaptionOne hover:underline hover:text-onBackgroundLink dark:hover:text-darkOnBackgroundLink mb-[1px]' 
               aria-label='Link to {$content}'>
               {$content}
            </a>";
    }
}
?>
