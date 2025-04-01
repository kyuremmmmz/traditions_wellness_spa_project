<?php

namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Buttons\ActionButtons;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Drawers\NewAppointment;
use Project\App\Views\Php\Components\Drawers\UpdateAppointment;
use Project\App\Views\Php\Components\Headers\PageTitle;
use Project\App\Views\Php\Components\Sections\AppointmentsSection;

class Page
{
    public static function page()
    {
?>
        <main class="flex w-full">
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:px-[0px] px-[48px] flex flex-col mt-[104px] sm:mt-[0px] sm:items-center sm:justify-center sm:h-screen  w-full">
                <div>
                    <?php PageTitle::render('clockMedium', 'Appointments') ?>
                    <section class="flex gap-[16px] py-[24px]"> <?php ActionButtons::render([['id' => 'openBookAnAppointmentButton', 'content' => '+ Book an appointment']]); ?>  </section>
                    <?php AppointmentsSection::render(); ?>
                </div>
            </div>
        </main>

        <?php Sidebar::render(); ?>
        <?php WorkingBanner::render() ?>
        <?php NewAppointment::render(); ?>
        <?php UpdateAppointment::render(); ?>

        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Appointments/AppointmentsDomm.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Appointments/appointmentsTableRealtimee.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Appointments/AppointmentValidation.js"></script>
        
        <?php
        if (!empty($GLOBALS['footer_scripts'])) {
            foreach ($GLOBALS['footer_scripts'] as $script) {
                echo $script;
            }
        }
    }
}

Page::page();