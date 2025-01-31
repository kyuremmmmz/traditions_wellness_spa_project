<?php
namespace Project\App\Views\Php\Components\Text;

class Subheader_1 {
    public static function render(string $content, string $color) {
        ?>
        <span class="text-<?php $color ?> text-tracking[-0.35px] text-[22px] font-medium">
            <?= htmlspecialchars($content) ?>
        </span>
        <?php
    }
}
?>
