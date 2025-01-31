<?php

use Project\App\Views\Php\Components\Verification;



class Page{
    public static function page(){
        ?>
        <div>
            <?php Verification::render() ?>
        </div>
    <?php
    }
}