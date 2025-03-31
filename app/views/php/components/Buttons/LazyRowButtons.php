<?php

namespace Project\App\Views\Php\Components\Buttons;

class LazyRowButtons
{
    public static function render(array $buttons): void
    {
        echo '<div class="border-b border-border flex dark:border-darkBorder h-[30px] max-w-full overflow-x-auto">';

        foreach ($buttons as $button) {
            $id = $button[0];
            $label = $button[1];
            echo "<button type=\"button\" id=\"$id\" class=\"px-[16px] h-[30px] w-full CaptionMediumOne leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface bg-background dark:bg-darkBackground appearance-none whitespace-nowrap\">$label</button>";
        }

        echo '</div>';
    }
}