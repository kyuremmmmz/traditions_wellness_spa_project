<?php
namespace Project\App\Views\Php\Components\Text;

class Body_Medium_2 {
    public static function render(string $content, string $color) {
        ?>
        <span class="text-<?php $color ?> text-tracking[-0.35px] text-[10px] font-regular">
            <?= htmlspecialchars($content, ) ?>
    </span>
        <?php
    }
}
?>