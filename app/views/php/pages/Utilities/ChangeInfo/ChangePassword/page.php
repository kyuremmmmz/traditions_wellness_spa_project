<?php

use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Buttons\GlobalButton;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\Text;

class Page
{
    public static function page()
    {
?>
        <main class="flex w-full">
            <div class="overflow-y-auto flex flex-col w-full items-center mt-[104px] sm:mt-[160px] mx-[48px] xm:mx-0">
                <section class="p-[48px] sm:m-0 sm:p-0 overflow-y-auto fixed inset-0 bg-background dark:bg-darkBackground flex flex-col items-center pt-[56px] sm:pt-[160px] w-full transform transition-transform duration-300 ease-in-out z-20 sm:z-5 sm:pb-[320px]">
                    <!-- Back Button -->
                    <section class="flex justify-start mb-[24px] min-w-[316px] max-w-[400px] w-full">
                        <div class="relative right-[12px]">
                            <a href="/account">
                                <?php GlobalButton::render('backSmall', '', '', '', ''); ?>
                            </a>
                        </div>
                    </section>
                    <!-- Content -->
                    <section class="flex flex-col mb-[32px] min-w-[316px] max-w-[400px] w-full ">
                        <form action="/updatePassword" method="post">
                            <div class="flex flex-col gap-[24px] mb-[24px]">
                                <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground', 'Change Password');
                                Text::render('', '', 'BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the following.'); ?>
                            </div>
                            <?php GlobalInputField::render('oldPasswordInputField', 'Old Password', 'password', 'oldPasswordInputField');
                            GlobalInputField::render('NewPasswordInputField', 'New Password', 'password', 'newPasswordInputField');
                            GlobalInputField::render('ConfirmPasswordInputField', 'Confirm Password', 'password', 'confirmPasswordInputField'); ?>
                            <div class="w-full flex justify-center mt-[150px]">
                                <?php GlobalButton::render('primary', 'Continue', '', '', '', 'submit') ?>
                            </div>
                        </form>
                    </section>
                </section>
            </div>
            <?php
            WorkingBanner::render();
            Sidebar::render(); ?>
        </main>
<?php
    }
}
Page::page();
