<?php

namespace Project\App\Views\Php\Components\Buttons;

class NewPrimaryButton
{
    public static function render(string $content, string $type, string $id,string $width, ?string $disabled = null, string $color = "primary"): void
    {
        if ($color == "primary") {
            ?>  <button type="<?php echo $type ?>" class="text-onPrimary dark:text-darkOnPrimary transition-all ease-in-out BodyTwo bg-primary dark:bg-darkPrimary hover:bg-primaryHover dark:hover:bg-darkPrimaryHover disabled:bg-secondaryVariant dark:disabled:bg-darkSecondaryVariant rounded-[6px] w-[<?php echo $width ?>] h-[40px]" <?php $disabled ?> id="<?php echo $id ?>"> <?php 
        } else if ($color == "destructive") {
            ?>  <button type="<?php echo $type ?>" class="text-onPrimary dark:text-darkOnPrimary transition-all ease-in-out BodyTwo bg-destructive dark:bg-darkDestructive rounded-[6px] w-[<?php echo $width ?>] h-[40px]" <?php $disabled ?> id="<?php echo $id ?>"> <?php
        } else {
            ?>  <button type="<?php echo $type ?>" class="text-onBackground border border-border dark:border-darkBorder dark:text-darkOnBackground transition-all ease-in-out BodyTwo bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px] w-[<?php echo $width ?>] h-[40px]" <?php $disabled ?> id="<?php echo $id ?>"> <?php
        }
            echo    $content ?> 
                </button>
        <?php 
    }
}