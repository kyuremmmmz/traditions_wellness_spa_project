<?php

namespace Project\App\Views\Php\Components\Photo;

class Photo
{
    public static function render(?string $className = null): void
    {
?>
        <div>
            <?php
            // Debugging: Check if the session variable is set and its value
            if (isset($_SESSION['user']['photos'])) {
                echo "Photo path: " . $_SESSION['user']['photos'];
            } else {
                echo "Photo path is not set.";
            }
            ?>
            <img src="<?= $_SESSION['user']['photos']; ?>" alt="<?= $_SESSION['user']['first_name']; ?>" width="100" height="100" class="rounded-full cursor-pointer">
        </div>
<?php
    }
}
