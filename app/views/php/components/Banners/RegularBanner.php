<?php

namespace Project\App\Views\Php\Components\Banners;

use Project\App\Views\Php\Components\Buttons\SmallExitButton;
use Project\App\Views\Php\Components\Icons\IconChoice;

class RegularBanner
{
    public static function render(string $bannerTitle, string $bannerDescription, string $bannerIcon, string $lightstroke, string $darkstroke): void
    {
        echo '          <div class="absolute w-[380px] h-[96px] top-[4px] mx-[14px] mt-[14px] right-[4px] flex justify-between items-center bg-background dark:bg-darkBackground border-border dark:border-darkBorder border-[2px] rounded-[6px] p-[24px] transition-all duration-500 ease-out opacity-1 translate-y-0" id="banner">
                            <div class="w-[32px] h-[32px]">';
                                IconChoice::render("{$bannerIcon}", "[32px]", "[32px]", "", "{$lightstroke}", "{$darkstroke}");
        
        echo <<<HTML
                            </div>
                            <div class="w-[234px] h-[47px]">
                                <p class="BodyMediumOne mb-[8px] w-[234px] h-[12px] text-onBackground dark:text-darkOnBackground">$bannerTitle</p>
                                <p class="CaptionOne w-[234px] h-[27px] text-onBackground dark:text-darkOnBackground">$bannerDescription</p>
                            </div>
                            <div class="h-[47px] w-[12px]">
        HTML;
                                SmallExitButton::render("banner");
        echo '              </div>
                        </div>';
        echo <<<HTML
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                let banner = document.getElementById('banner');
                                
                                if (banner) {
                                        banner.style.opacity = "1";
                                        banner.style.transform = "translateY(0px)";

                                    // Fade-out after the banner has been visible for 5 seconds
                                    setTimeout(function() {
                                        banner.style.opacity = "0";  // Fade out the banner
                                        banner.style.transform = "translateY(-10px)"; // Slightly move up
                                    }, 5000); // Wait 5 seconds before starting to fade out

                                    // Hide the banner completely after fading out
                                    setTimeout(function() {
                                        banner.style.display = "none";
                                    }, 6000);
                                }
                            });
                        </script>

        HTML;
    }
}