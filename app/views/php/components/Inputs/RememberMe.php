<?php
namespace Project\App\Views\Php\Components\Inputs;

class RememberMe {
    public static function render($name = "remember_me", $checked = false) {

        // TODO: NEED REMEMBER ME FUNCTION!

        echo <<<HTML
        <div class="flex gap-[10px]"> 
                <div class="flex justify-center items-center">
                <label class="w-[24px] h-[24px]">
                    <input class="peer cursor-pointer hidden after:opacity-100" type="checkbox" name="$name"/>
                    <span class="inline-block w-[24px] h-[24px] border-[2px] border-borderTwo dark:border-darkBorderTwo relative rounded-[6px] cursor-pointer after:content-[''] after:absolute after:top-2/4 after:left-2/4 after:-translate-x-1/2 after:-translate-y-1/2 after:w-[12px] after:h-[12px] after:bg-primary dark:after:bg-darkPrimary after:rounded-[2px] after:opacity-0 peer-checked:after:opacity-100"></span>
                </label>
            </div>
            <label class="text-onBackgroundTwo dark:text-darkOnBackgroundTwo CaptionOne h-[24px] flex justify-center items-center">Remember me</label>
        </div>
        HTML;
    }
}
?>
