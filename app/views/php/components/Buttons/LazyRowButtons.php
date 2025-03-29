<?php

namespace Project\App\Views\Php\Components\Buttons;

class LazyRowButtons
{
    public static function render(array $buttons): void
    {
        echo '<div class="border-b border-border flex dark:border-darkBorder h-[30px] overflow-x-auto">';
        echo '<div class="mx-[24px] h-[30px]">';
        
        foreach ($buttons as $button) {
            $id = $button[0];
            $label = $button[1];
            echo "<button type=\"button\" id=\"$id\" class=\"px-[16px] h-[30px] CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none\">$label</button>";
        }
        
        echo '</div>';
        echo '</div>';
    }
}