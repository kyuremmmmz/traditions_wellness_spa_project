<?php

namespace Project\App\Views\Php\Pages\Verification;

use Project\App\Views\Php\Components\Buttons\ReturnButton;
use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\HeaderTwo;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Texts\BodyTwo;
use Project\App\Views\Php\Components\Texts\Text;

class Page
{
    public static function verification()
    {
        // TODO: error kineme
        session_start();
        $verificationError = $_SESSION['forgot_password_errors']['verification'] ?? '';
        //unset($_SESSION['forgot_password_errors']);


        // start of page
?>
        <form action="/forgotPass" method="POST">
            <?php
            Header::render('Small');
            echo        '<main class="OneColumnContainer mt-[24px] sm:mt-[24px] bg-background dark:bg-darkBackground">';
            ReturnButton::render("[316px]", "/forgotpassword");
            Text::render("","", "HeaderTwo text-left text-onBackground dark:text-darkOnBackground mt-[40px] mb-[8px]", "Verification Code");
            Text::render('','', 'BodyTwo w-[316px] mb-[16px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the verification code we sent to your email');
            GlobalInputField::render('verification', 'Verification Code', 'text', 'verification_field_forgot_password', $verificationError);
            echo '<div class="w-[326px] flex justify-center">';
            PrimaryButton::render("Continue", "submit", "[200px]", "", "", "", "Continue");
            echo '</div>';
            // Testing
            echo <<<HTML

                <div class="border-border rounded-[6px] border-[2px] mb-[24px] w-[50px] h-[50px] flex flex-col">
                    <button class="w-inherit rounded-[6px] text-left BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        k
                    </button>
                </div>


                <div class="border-border rounded-[6px] border-[2px] flex flex-col w-[316px]">
                    <button class="w-inherit rounded-tr-[5px] rounded-tl-[5px] h-[40px] text-left BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Personal Info
                    </button>

                    <button class="w-inherit h-[40px] text-left BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Activities
                    </button>

                    <button class="w-inherit h-[40px] text-left BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Security
                    </button>

                    <button class="w-inherit rounded-br-[5px] rounded-bl-[5px] h-[40px] text-left BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Report Tickets
                    </button>
                </div>

                <div class="border-border rounded-[6px] border-[2px] mt-[24px] flex flex-col w-[316px]">
                    <button class="w-inherit h-[40px] rounded-[5px] text-left BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        About
                    </button>

                </div>

                HTML;

                echo Text::render('','', 'text-onBackgroundTwo CaptionMediumOne ', 'Tools');

                echo <<<HTML

                <div class="border-border sm:border-none rounded-[6px] border-[2px] flex flex-col w-[316px] mt-[24px] sm:w-[241px]">
                    <button class="w-inherit rounded-tr-[5px] rounded-tl-[5px] h-[40px] sm:h-[32px] text-left BodyMediumTwo bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Dashboard
                    </button>

                    <button class="w-inherit h-[40px] sm:h-[32px] text-left BodyMediumTwo bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Appointments
                    </button>

                    <button class="w-inherit h-[40px] sm:h-[32px] text-left BodyMediumTwo bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Employees
                    </button>

                    <button class="w-inherit h-[40px] sm:h-[32px] text-left BodyMediumTwo bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Finances
                    </button>

                    <button class="w-inherit h-[40px] sm:h-[32px] text-left BodyMediumTwo bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Inventory
                    </button>

                    <button class="w-inherit h-[40px] sm:h-[32px] text-left BodyMediumTwo bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Branches
                    </button>

                    <button class="w-inherit h-[40px] sm:h-[32px] text-left BodyMediumTwo bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Services
                    </button>

                    <button class="w-inherit rounded-br-[5px] rounded-bl-[5px] h-[40px] sm:h-[32px] text-left BodyMediumTwo sm:bg-surface sm:dark:bg-darkSurface bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Users
                    </button>
                </div>

                HTML;

                echo Text::render('','', 'text-onBackgroundTwo CaptionMediumOne ', 'Utilities');

                echo <<<HTML

                <div class="border-border sm:border-none rounded-[6px] border-[2px] flex flex-col w-[316px] mt-[12px] sm:w-[241px]">
                    <button class="w-inherit rounded-tr-[5px] rounded-tl-[5px] h-[40px] sm:h-[32px] text-left BodyMediumTwo bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Calendar
                    </button>

                    <button class="w-inherit h-[40px] sm:h-[32px] text-left BodyMediumTwo bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Messages
                    </button>

                    <button class="w-inherit h-[40px] sm:h-[32px] text-left BodyMediumTwo bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Notifications
                    </button>

                    <button class="w-inherit h-[40px] sm:h-[32px] text-left BodyMediumTwo bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Task & Routines
                    </button>

                    <button class="w-inherit rounded-br-[5px] sm:h-[32px] rounded-bl-[5px] h-[40px] text-left BodyMediumTwo bg-background dark:bg-darkBackground sm:bg-surface sm:dark:bg-darkSurface text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Feedback & Reports
                    </button>
                </div>

                <div class="border-border rounded-[6px] border-[2px] flex flex-col w-[316px] mt-[12px]">

                    <button class="w-inherit rounded-tr-[5px] rounded-tl-[5px] h-[40px] text-left BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Change Password
                    </button>

                    <button class="w-inherit h-[40px] text-left BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Change Email
                    </button>

                    <button class="w-inherit rounded-br-[5px] rounded-bl-[5px] h-[40px]  text-left BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                        Change Phone Number
                    </button>
                </div>


            HTML;

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



            ?>
        </form>

<?php

    }
}

Page::verification();
