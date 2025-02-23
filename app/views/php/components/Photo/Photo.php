<?php

namespace Project\App\Views\Php\Components\Photo;

class Photo
{
    public static function render(?string $className = null): void
    {
?>
        <div>
            <img src="<?= $_SESSION['user']['photos']; ?>" alt="<?= $_SESSION['user']['first_name']; ?>" width="100" height="100" class="rounded-full cursor-pointer">
        </div>
<?php
    }
}
