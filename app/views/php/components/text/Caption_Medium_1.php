<?php
namespace Project\App\Views\Php\Components\Text;

class Caption_Medium_1 {
    public static function render(string $content, string $color) {
        ?>
        <span class="text-<?php $color ?> text-tracking[-0.35px] text-[12px] font-medium">
            <?= htmlspecialchars($content) ?>
        </span>
        <?php
    }
}
?>