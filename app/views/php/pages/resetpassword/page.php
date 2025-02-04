<?php

use Project\App\Views\Php\Components\Forms\Reset;

class Page{
    public static function page(){
        ?>
        <div class="flex flex-col justify-center items-center py-20">
            <?php Reset::render()  ?>
        </>
    <?php
    }
}

Page::page();