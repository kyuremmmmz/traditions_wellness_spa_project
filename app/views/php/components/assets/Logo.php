<?php
namespace Project\App\Views\Php\Components\Assets;

class Logo {
    public static function render($class = "") {
        echo '
        <div class="flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" 
                 width="182" height="182" 
                 viewBox="0 0 182 182" 
                 fill="none"
                 class="w-[182px] h-[182px] flex-shrink-0">
                <circle cx="91" cy="91" r="91" fill="#0F172A"/>
            </svg>
        </div>';
    }
}
?>
