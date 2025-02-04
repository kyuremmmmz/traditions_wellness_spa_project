<?php

use Project\App\Views\Php\Components\Validations\Reset;

class Page{
    public static function page(){
        ?>
        <div class="flex flex-col items-center justify-center py-20">
            <?php Reset::render()  ?>
        </>
    <?php
    }
}

Page::page();