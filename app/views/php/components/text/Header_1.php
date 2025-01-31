<?php
namespace Project\App\Views\Php\Components\Text;

class Header_1 {
    public static function render(string $content, string $color) {
        ?>
        <span class="text-<?php $color ?> text-tracking[-0.35px] text-[28px] font-semibold">
            <?= htmlspecialchars($content) ?>
        </span7>
        <?php
    }
}
?>
