<?php
namespace Project\App\Views\Php\Components\Text;

class Body_2 {
    public static function render(string $content, string $color) {
        ?>
        <span class="text-<?php $color ?> text-tracking[-0.35px] text-[14px] font-regular">
            <?= htmlspecialchars($content, ) ?>
    </span>
        <?php
    }
}
?>