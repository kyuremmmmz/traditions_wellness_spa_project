<?php
namespace Project\App\Views\Php\Pages\Tools\Appointments\Tracker;
use Project\App\Views\Php\Components\Containers\Sidebar;

class Page {
    public static function page() {
        ?>
        <div>
            <h1></h1>
        </div>
        <?php
        Sidebar::render();
    }
}
Page::page();