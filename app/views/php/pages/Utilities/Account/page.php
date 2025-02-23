<?php

namespace Project\App\Views\Php\Pages\Utilities\Account;

use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Buttons\GlobalButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Texts\Text;


class Page
{
    public static function page()
    {

?>
        <main class="flex w-full">
            <div id="main" class="overflow-y-auto px-[48px] flex flex-col sm:items-center mt-[104px] sm:mt-[160px] w-full">
                <div id="topSection">
                    <section class="flex h-[50px]">
                        <button class="min-w-[50px] min-h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface transition-all rounded-[6px] flex justify-center items-center">
                            <?php IconChoice::render('settingsMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <div class="h-full flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[8px] gap-[4px]">
                            <?php echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Account Settings');
                            echo LastUpdated::render(); ?>
                        </div>
                    </section>
                    <section>
                        <?php GlobalButton::render('primary', 'Get Started', '');?>
                    </section>

                    <!--
                    <section class="flex mt-[24px]">
                        <button id="addANewServiceButton" class="min-w-[200px] min-h-[42px] flex justify-start items-center pl-[12px] bg-primary dark:bg-darkPrimary hover:bg-primaryHover dark:hover:bg-darkPrimaryHover rounded-[6px] transition-all">
                            <?php // IconChoice::render('addServiceSmall', '[16px]', '[16px]', '', 'onPrimary', 'darkOnPrimary');
                            // Text::render('', '', 'BodyTwo leading-none text-onPrimary dark:text-darkOnPrimary pl-[12px]', 'Add a new service'); ?>
                        </button>
                    </section>
                    -->

                    <div id="personalInfoSection" class="ml-[0px] sm:ml-[48px] p-[48px] sm:p-0 overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col sm:items-start sm:pl-[10%] sm:pt-[160px] w-full transform translate-x-full transition-transform duration-300 ease-in-out z-20 sm:z-5 sm:pb-[320px]">
                        <div class="flex justify-start mb-[48px] min-w-[316px] max-w-[400px] w-full">
                            <button id="closeButton" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                                <div class="w-[24px] h-[24px] flex justify-center items-center">
                                    <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                                </div>
                            </button>
                        </div>
                        <form method="post" action="/">
                            <div class="w-full flex sm:items-start flex-col">
                                <section class="flex flex-col gap-[12px] min-w-[316px] w-full justify-center sm:justify-start">
                                    <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground', 'Add a new category');
                                    Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the following.'); ?>
                                </section>
                                <section class="mt-[64px] translate-y-4 transition-all duration-500 ease-in-out delay-400 min-w-[316px] flex flex-col w-full items-center sm:items-start" data-step="2" hidden>
                                    <div class="flex items-end w-full max-w-[400px]">
                                        <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Name.&nbsp;'); ?>
                                        <?php Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', 'What is it called?'); ?>
                                    </div>
                                    <div class="w-full flex justify-center sm:justify-start">
                                        <div class="mt-[24px] min-w-[316px] w-full max-w-[400px]">
                                            <?php GlobalInputField::render('categoryNameField', 'Service Name', 'text', '', ''); ?>
                                        </div>
                                    </div>
                                </section>
                                <section class="mt-[64px] translate-y-4 transition-all duration-500 ease-in-out delay-400 min-w-[316px] flex flex-col w-full items-center sm:items-start" data-step="2" hidden>
                                    <div class="flex items-end w-full max-w-[400px]">
                                        <?php Text::render('', '', 'BodyMediumOne leading-none text-onBackground dark:text-darkOnBackground', 'Icon.&nbsp;'); ?>
                                        <?php Text::render('', '', 'BodyMediumTwo leading-none text-onSurface dark:text-darkOnSurface', ''); ?>
                                    </div>
                                    <div class="w-full flex justify-center sm:justify-start">
                                        <div class="mt-[24px] min-w-[316px] w-full max-w-[400px]">
                                            <?php GlobalInputField::render('categoryNameField', 'Service Name', 'text', '', ''); ?>
                                        </div>
                                    </div>
                                </section>
                                <div class="flex justify-center gap-2 mt-[48px]">
                                    <?php PrimaryButton::render('Create', 'submit'); ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php /*

                    echo        '</main>';
                    echo        ReturnButton::render("[316px]", "");
                    echo        Text::render("","", "HeaderTwo text-left text-onBackground dark:text-darkOnBackground mt-[40px] mb-[8px]", "Personal Info");
                    echo        GlobalInputField::render('', 'First Name', 'text', '', '');
                    echo        GlobalInputField::render('', 'Last Name', 'text', '', '');
                    echo        PrimaryButton::render("Continue", "submit", "[200px]", "", "", "", "Continue");

                    echo        ReturnButton::render("[316px]", "");
                    echo        Text::render("","", "HeaderTwo text-left text-onBackground dark:text-darkOnBackground mt-[40px] mb-[8px]", "Change Password");
                    echo        Text::render('','', 'BodyTwo w-[316px] mb-[16px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo', "Please enter your new password below.");
                    echo        GlobalInputField::render('', 'Old Password', 'password', '', '');
                    echo        GlobalInputField::render('', 'New Password', 'password', '', '');
                    echo        GlobalInputField::render('', 'Confirm Password', 'password', '', '');
                    echo        PrimaryButton::render("Continue", "submit", "[200px]", "", "", "", "Continue");


                    echo        ReturnButton::render("[316px]", "");
                    echo        Text::render("","", "HeaderTwo text-left text-onBackground dark:text-darkOnBackground mt-[40px] mb-[8px]", "Change Email");
                    echo        Text::render('','', 'BodyTwo w-[316px] mb-[16px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo', "Please enter your new email address below. We'll send you a code.");
                    echo        GlobalInputField::render('', 'Email', 'email', '', '');
                    echo        PrimaryButton::render("Continue", "submit", "[200px]", "", "", "", "Continue");

                    echo        ReturnButton::render("[316px]", "");
                    echo        Text::render("","", "HeaderTwo text-left text-onBackground dark:text-darkOnBackground mt-[40px] mb-[8px]", "Verification Code");
                    echo        Text::render('','', 'BodyTwo w-[316px] mb-[16px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo', "Please enter the verification code we sent to your email.");
                    echo        GlobalInputField::render('', 'Verification Code', 'verification', '', '');
                    echo        PrimaryButton::render("Continue", "submit", "[200px]", "", "", "", "Continue");

                    echo        ReturnButton::render("[316px]", "");
                    echo        Text::render("","", "HeaderTwo text-left text-onBackground dark:text-darkOnBackground mt-[40px] mb-[8px]", "Change Number");
                    echo        Text::render('','', 'BodyTwo w-[316px] mb-[16px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo', "Please enter your new phone number below. We'll send you a code.");
                    echo        GlobalInputField::render('', 'Phone Number', 'phone number', '', '');
                    echo        PrimaryButton::render("Continue", "submit", "[200px]", "", "", "", "Continue");

                    echo        ReturnButton::render("[316px]", "");
                    echo        Text::render("","", "HeaderTwo text-left text-onBackground dark:text-darkOnBackground mt-[40px] mb-[8px]", "Verification Code");
                    echo        Text::render('','', 'BodyTwo w-[316px] mb-[16px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo', "Please enter the verification code we sent to your phone number.");
                    echo        GlobalInputField::render('', 'Verification Code', 'verification', '', '');
                    echo        PrimaryButton::render("Continue", "submit", "[200px]", "", "", "", "Continue");


                    */
                    ?>

                    
                </div>
            </div>
            <?php Sidebar::render(); ?>
        </main>
        <?php
    }
}

Page::page();
