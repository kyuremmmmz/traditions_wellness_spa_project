<?php
namespace Project\App\Views\Php\Components\Text;

class Subheader_2 {
    public static function render(string $content, string $color) {
        ?>
        <span class="text-<?php $color ?> text-tracking[-0.35px] text-[17px] font-medium">
            <?= htmlspecialchars($content, ) ?>
    </span>
        <?php
    }
}
?>