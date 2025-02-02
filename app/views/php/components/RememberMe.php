<?php
namespace Project\App\Views\Php\Components;

class RememberMe {
    public static function render($checked = false) {
        echo '
        <div class="flex items-center space-x-2">
            <input type="checkbox"
                   id="rememberMe"
                   name="rememberMe" ' . ($checked ? 'checked' : '') . '
                   class="w-[18px] h-[18px] flex-shrink-0 border-border rounded-[6px] bg-background checked:border-primary focus:ring-primary">
            <label for="rememberMe"
                   class="text-on.background-2 text-[12px] leading-[18px] font-medium">Remember me</label>
        </div>';
    }
}
?>
