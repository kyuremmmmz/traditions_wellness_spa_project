<?php

namespace Project\App\Views\Php\Components\Buttons;

class ActionButtons
{
    public static function render(array $buttons): void
    {
        ?>
        <div class="flex sm:flex-row sm:gap-[16px] border-border dark:border-darkBorder rounded-[6px] border-[1px] sm:border-0 flex flex-col w-full">
            <?php foreach ($buttons as $button): ?>
                <button 
                    type="button" 
                    class="sm:text-onPrimary sm:dark:text-darkOnPrimary text-onSurface dark:text-darkOnSurface transition-all ease-in-out sm:BodyTwo BodyMediumTwo sm:bg-primary sm:dark:bg-darkPrimary bg-background dark:bg-darkBackground sm:hover:bg-primaryHover sm:dark:hover:bg-darkPrimaryHover hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface sm:rounded-[6px] rounded-[5px] sm:w-[219px] sm:min-w-[219px] h-[40px]" 
                    id="<?= htmlspecialchars($button['id'] ?? '') ?>"
                >
                    <div class="flex sm:gap-[8px] text-left px-[10px] sm:text-center sm:px-[0px] w-full items-center sm:justify-center">
                        <?= htmlspecialchars($button['content'] ?? '') ?>
                    </div>
                </button>
            <?php endforeach; ?>
        </div>
        <?php
    }
}
