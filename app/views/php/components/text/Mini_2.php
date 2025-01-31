<?php
namespace Project\App\Views\Php\Components\Text;

class Mini_2 {
    public static function render(string $content, string $color) {
        ?>
        <span class="text-<?php $color ?> text-tracking[-0.35px] text-[8px] font-regular">
            <?= htmlspecialchars($content, ) ?>
    </span>
        <?php
    }
}
?>