<?php

namespace Project\App\Views\Php\Pages\Utilities\Account;

use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Buttons\GlobalButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Inputs\SelectField;
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
            <div class="overflow-y-auto flex flex-col w-full items-center mt-[104px] sm:mt-[160px] mx-[48px] xm:mx-0">
                <!-- Main -->
                <section id="mainSection" class="overflow-y-auto flex sm:p-0 flex-col sm:items-center w-full min-w-[316px] max-w-[400px]">
                    <section class="flex h-[50px] w-full">
                        <button class="min-w-[50px] min-h-[50px] max-w-[50px] max-h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface transition-all rounded-[6px] flex justify-center items-center">
                            <?php Photo::render(); ?>
                        </button>
                        <div class="h-full flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[8px] gap-[4px]">
                            <?php Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', $userFullNameOnSettings);
                            Text::render('', '', 'CaptionOne text-onBackground text-left dark:text-darkOnBackground leading-none', $userRoleOnSettings); ?>
                        </div>
                    </section>
                    <section class="flex flex-col gap-[24px] mt-[24px] w-full min-w-[316px] max-w-[400px] sm:items-center">
                        <div class="border-border dark:border-darkBorder rounded-[6px] border-[1px] flex flex-col w-full">
                            <?php GlobalButton::render("navigationSecondaryTop", "Personal Information", "", "userSmall", 'openPersonalInformationButton');
                            GlobalButton::render("navigationSecondaryMiddle", "Activities", "", "activitiesSmall");
                            GlobalButton::render("navigationSecondaryMiddle", "Security", "", "securitySmall");
                            GlobalButton::render("navigationSecondaryMiddle", "Report Tickets", "", "reportTicketSmall"); 
                            GlobalButton::render("navigationSecondaryBottom", "About", "", "aboutSmall"); ?>
                        </div>   
                        <div class="border-border dark:border-darkBorder rounded-[6px] border-[1px] flex flex-col w-full">
                            <?php GlobalButton::render("navigationSecondary", "Logout", "", "logoutSmall"); ?>
                        </div> 
                    </section>  
                </section>

                <!-- Personal Info Modal -->
                <section id="personalInformationModal" class="p-[48px] sm:m-0 sm:p-0 overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col items-center pt-[56px] sm:pt-[160px] w-full transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-5 sm:pb-[320px]">
                    <!-- Back Button -->
                    <section class="flex justify-center mb-[24px] min-w-[316px] max-w-[400px] w-full">
                        <div class="relative right-[12px]">
                            <?php GlobalButton::render('backSmall', '', '', '', 'closePersonalInformationButton' ); ?>
                        </div>
                        <?php Text::render('', '', 'BodyMediumOne leading-none w-full h-[32px] relative right-[16px] flex items-center justify-center text-onBackground text-center dark:text-darkOnBackground', 'Personal Information'); ?>
                    </section>
                    <section class="flex flex-col mb-[32px] min-w-[316px] max-w-[400px] w-full">
                        <?php GlobalInputField::render('firstNameInputField', 'First Name', 'text', '', '', '', '');
                        GlobalInputField::render('lastNameInputField', 'Last Name', 'text', '', '', '', '');
                        $options = array(
                            'Male' => 'Male',
                            'Female' => 'Female',
                            'Other' => 'Other',
                        );
                        SelectField::render($options, 'Gender', 'gender', 'genderSelectField', 'Male'); ?>
                        <div class="mt-[200px] flex justify-center ">
                            <?php GlobalButton::render('primary', 'Save', '', '', 'savePersonalInformationButton');?>
                        </div>
                    </section>
                </section>

                <!-- Personal Information Confirmation Dialog Box -->
                <div id="personalInformationConfirmationDialogBox" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[1000]">
                    <div class="bg-background dark:bg-darkBackground p-[48px] border-border border-[1px] dark:border-darkBorder flex flex-col justify-between rounded-[6px] w-[364px] sm:w-[496px] z-[60]">
                        <div class="flex flex-col justify-center gap-2 mt-[48px]">
                            <?php Text::render('', '', 'BodyOne m-0 p-0 leading-none text-center text-onBackground dark:text-darkOnBackground mb-[48px]', 'Are you sure you want to proceed?'); ?>
                            <div class="flex w-full justify-center gap-[24px]">
                                <?php GlobalButton::render("primary", 'Proceed', '', '', '');
                                GlobalButton::render('secondary', "Cancel", "", "", "closePersonalInformationConfirmationDialogBox"); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- More Dialog Boxes-->
            </div>
            <?php Sidebar::render(); ?>
        </main>
        <?php
    }
}

Page::page();
