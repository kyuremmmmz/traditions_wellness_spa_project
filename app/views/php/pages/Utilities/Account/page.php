<?php

namespace Project\App\Views\Php\Pages\Utilities\Account;

use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Buttons\GlobalButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Photo\Photo;


class Page
{
    public static function page()
    {
        $userFullNameOnSettings = $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];
        $userRoleOnSettings = $_SESSION['user']['role'];

?>
        <main class="flex w-full">
            <div id="mainSection" class="overflow-y-auto px-[48px] flex flex-col sm:items-center mt-[104px] sm:mt-[160px] w-full">
                <div id="mainSection">
                    <section class="flex h-[50px]">
                        <button class="min-w-[50px] min-h-[50px] max-w-[50px] max-h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface transition-all rounded-[6px] flex justify-center items-center">
                            <?php Photo::render(); ?>
                        </button>
                        <div class="h-full flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[8px] gap-[4px]">
                            <?php Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', $userFullNameOnSettings);
                            Text::render('', '', 'CaptionOne text-onBackground text-left dark:text-darkOnBackground leading-none', $userRoleOnSettings); ?>
                        </div>
                    </section>
                    
                    <section class="flex flex-col gap-[24px] mt-[24px]">
                        <div class="border-border rounded-[6px] border-[1px] flex flex-col min-w-[316px] w-full max-w-[400px]">
                            <?php GlobalButton::render("navigationSecondaryTop", "Personal Information", "", "userSmall");
                            GlobalButton::render("navigationSecondaryMiddle", "Activities", "", "activitiesSmall");
                            GlobalButton::render("navigationSecondaryMiddle", "Security", "", "securitySmall");
                            GlobalButton::render("navigationSecondaryMiddle", "Report Tickets", "", "reportTicketSmall"); 
                            GlobalButton::render("navigationSecondaryBottom", "About", "", "aboutSmall"); ?>
                        </div>   
                        <div class="border-border rounded-[6px] border-[1px] flex flex-col min-w-[316px] w-full max-w-[400px]">
                            <?php GlobalButton::render("navigationSecondary", "Logout", "", "logoutSmall"); ?>
                        </div> 
                    </section>            
                </div>
            </div>
            
            <?php Sidebar::render(); ?>
        </main>
        <?php
    }
}

Page::page();
