<?php
namespace Project\App\Views\Php\Components\Assets;

class SubmarkLogo { // FINAL
    public static function render(string $width, string $height, string $containerwidth, string $containerheight): void {
        $svgPath = __DIR__ . "/../../../assets/smallLogo.svg";
        echo    '<div class="w-{$containerwidth} h-{$containerheight} flex justify-center">';
        if (file_exists($svgPath)) {
            $svgContent = file_get_contents($svgPath);
            echo preg_replace('/<svg/', '<svg class="fill-primary dark:fill-darkPrimary w-' . $width . ' h-' . $height . '""', $svgContent);
        } else {
            echo '<div class="text-red-500">SVG file not found</div>';
        }
        echo    '</div>';
    }
}