<?php
namespace Project\App\Views\Php\Components\Text;

class Header_2 {
    public static function render(string $content, string $color) {
        ?>
        <span class="text-<?php $color ?> text-tracking[-0.35px] text-[22px] font-semibold">
            <?= htmlspecialchars($content, ) ?>
    </span>
        <?php
    }
}
?>