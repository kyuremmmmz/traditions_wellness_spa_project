<?php

namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Buttons\ActionButtons;
use Project\App\Views\Php\Components\Buttons\LazyRowButtons;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Texts\TextRowContainer;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Buttons\NewPrimaryButton;
use Project\App\Views\Php\Components\Drawers\NewAddOn;
use Project\App\Views\Php\Components\Drawers\NewService;
use Project\App\Views\Php\Components\Drawers\UpdateAddOn;
use Project\App\Views\Php\Components\Drawers\UpdateService;
use Project\App\Views\Php\Components\Headers\PageTitle;
use Project\App\Views\Php\Components\Sections\LazyGrid;

class Page
{
    public static function page()
    {
?>
        <main class="flex w-full">
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:px-[0px] px-[48px] flex flex-col mt-[104px] sm:mt-[0px] sm:items-center sm:justify-center sm:h-screen  w-full">
                <div>
                    <?php PageTitle::render('servicesMedium', 'Services') ?>
                    <section class="flex gap-[16px] py-[24px]"> <?php ActionButtons::render([['id' => 'openAddANewServiceSectionButton', 'content' => '+ Add a new service'],['id' => 'openAddANewAddOnSectionButton', 'content' => '+ Add a new add-on']]); ?> </section>
                    <section> <?php LazyRowButtons::render([['showAllServices', 'All Services'], ['showMassages', 'Massages'], ['showBodyScrubs', 'Body Scrubs'], ['showPackages', 'Packages'], ['showAddOns', 'Add-ons'], ['showArchivedServices', 'Archived Services'], ['showArchivedAddOns', 'Archived Add-ons']]); ?> </section>
                    <section> <?php LazyGrid::render([['allServices', true],['massages', true], ['bodyScrubs', true], ['packages', true], ['addOns', true], ['archivedServices', true], ['archivedAddOns', true]]); ?> </section>
                </div>
            </div>
        </main>

        <?php NewAddOn::render(); ?>
        <?php UpdateAddOn::render(); ?>   
        <?php NewService::render(); ?>
        <?php UpdateService::render(); ?>
        <?php Sidebar::render(); ?>
        <?php WorkingBanner::render(); ?> 

        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/ServicesManager.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/ServicesRenderer.js"></script>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/Services/AddOnsSelection.js"></script>

    <?php
        if (!empty($GLOBALS['footer_scripts'])) {
            foreach ($GLOBALS['footer_scripts'] as $script) {
                echo $script;
            }
        }
    }
}

Page::page();
