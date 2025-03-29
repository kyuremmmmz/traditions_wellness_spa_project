<?php

namespace Project\App\Views\Php\Components\Sections;

class LazyGrid
{
    public static function render(array $sections): void
    {
        echo '<div class="h-[640px] relative overflow-x-auto overflow-y-auto w-full">';
        
        foreach ($sections as $section) {
            $id = $section[0];
            $isGrid = $section[1] ?? true;
            
            $className = $isGrid 
                ? "grid grid-flow-col grid-rows-6 auto-cols-[365px] gap-[16px] p-[24px] absolute min-w-full transition-all duration-300 transform"
                : "flex flex-col items-center items-top p-[24px] absolute w-full transition-all duration-300 transform";
            
            echo "<section id=\"{$id}Section\" class=\"$className\"></section>";
        }
        
        echo '</div>';
    }
}