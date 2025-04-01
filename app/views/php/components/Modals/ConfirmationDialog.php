<?php

namespace Project\App\Views\Php\Components\Modals;

class ConfirmationDialog
{
    public static function render(string $id, string $description, string $proceedId, string $cancelId, string $proceedType, string $proceedColor): void
    {
        ?>
        <div id="<?php echo $id?>" class="hidden fixed top-0 left-0 right-0 bottom-0 w-screen h-screen bg-black bg-opacity-50 flex items-center justify-center z-[300]">
            <div class="border-border dark:border-darkBorder border bg-background dark:bg-darkBackground p-[48px] rounded-[6px] w-full sm:w-[412px] m-[48px] flex flex-col relative">
                <p class="BodyOne text-onBackground dark:text-darkOnBackground text-center my-[16px]"><?php echo $description ?></p>
                <div class="flex gap-[16px] flex-col-reverse w-full justify-center items-center sm:flex-row justify-end mt-[48px]">
                    <button type="button" id="<?php echo $cancelId ?>" class="BodyOne h-[40px] w-full sm:w-[180px]  py-[8px] rounded-[6px] text-onBackground dark:text-darkOnBackground bg-surface dark:bg-darkSurface border-border dark:border-darkBorde border-[1px] border hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">Cancel</button>
                    <?php if ($proceedColor == 'primary') {
                    echo '<button type="' . $proceedType .'" id="' .  $proceedId . '" class="BodyOne h-[40px] w-full sm:w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-primary dark:bg-darkPrimary">Proceed</button>';
                    } else {
                    echo '<button type="' . $proceedType .'" id="' .  $proceedId . '" class="BodyOne h-[40px] w-full sm:w-[180px] py-[8px] rounded-[6px] text-onPrimary dark:text-onPrimary bg-destructive dark:bg-darkDestructive">Proceed</button>';
                    } ?>
                </div>
            </div>
        </div>
        <?php
    }
}