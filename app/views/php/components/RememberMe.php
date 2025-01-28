<?php
namespace Project\App\Views\Php\Components;

class RememberMe {
    public static function render($name = "remember_me", $checked = false) {
        echo '
        <div class="flex items-center space-x-2">
            <input type="checkbox" 
                   id="' . htmlspecialchars($name) . '" 
                   name="' . htmlspecialchars($name) . '" ' . ($checked ? 'checked' : '') . ' 
                   class="w-[23.683px] h-[24px] flex-shrink-0 border border-gray-300 rounded-lg bg-white checked:bg-primary checked:border-primary focus:ring-primary">
            <label for="' . htmlspecialchars($name) . '" 
                   class="text-gray-500 text-[12px] leading-[18px] font-medium">Remember me</label>
        </div>';
    }
}
?>
