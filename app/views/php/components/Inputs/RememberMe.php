<?php
namespace Project\App\Views\Php\Components\Inputs;

class RememberMe {
    public static function render($name = "remember_me", $checked = false) {
        echo '
        <div class="flex gap-[10px]">
            <input type="checkbox" 
                   id="{$name})" 
                   name="{$name}"
                   class="w-[16px] h-[16px] mt-[1px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] bg-background dark:bg-darkBackground"/>
            <label class="text-onBackgroundTwo dark:text-darkOnBackgroundTwo CaptionOne mt-[1px]">Remember me</label>
        </div>';
    }
}
?>
