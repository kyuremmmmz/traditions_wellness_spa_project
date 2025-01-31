<?php
namespace Project\App\Views\Php\Components\Text;

class Body_1 {
    public static function render(string $content, string $color) {
        ?>
        <span class="text-<?php $color ?> text-tracking[-0.35px] text-[16px] font-regular">
            <?= htmlspecialchars($content, ) ?>
    </span>
        <?php
    }
}
?>