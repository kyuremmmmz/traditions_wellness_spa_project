<?php

namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Buttons\GlobalButton;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Inputs\SelectField;
use Project\App\Views\Php\Components\Texts\Text;

class Page
{
    public static function page()
    {
?>
        <main class="flex w-full">
            <?php Sidebar::render(); ?>
            <div class=" overflow-y-auto  flex flex-col mt-[104px] sm:mt-[160px] md:justify-center items-center w-full">
                <form class="flex flex-col gap-12" accept="" method="post">
                    <div class="flex flex-col gap-2">
                        <?php
                        Text::render('', '', 'text-onBackground dark:text-white text-[22px] font-[600]', 'Book an Appointment');
                        Text::render('', '', 'text-onBackground dark:text-white text-[14px] font-[400]', 'Please enter the following.');
                        ?>
                    </div>
                    <div class="flex flex-col">
                        <?php
                        Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', '1. Session Details ');
                        $options = array(
                            'Select',
                            'Walk-in',
                            'Branch'
                        );
                        $options2 = array(
                            'Select',
                            'Walk-in',
                            'Branch'
                        );
                        ?>
                        <div class="flex flex-col gap-[24px] pb-[48px]">
                            <?php
                            SelectField::render($options, 'Source of appointment', 'sourceOfAppointment');
                            SelectField::render($options2, 'Type of appointment', 'typeOfAppointment');
                            ?>
                        </div
                            </div>
                        <div id="" class="flex flex-col pb-[48px]">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', '2. Service Choice');
                            SelectField::render([], '', '', 'select');
                            ?>
                        </div>
                        <div>
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', '3. Customer Details');
                            GlobalInputField::render('search', 'Search for existing customer', 'text', '', '');
                            ?>
                        </div>
                        <div class="text-[16px]  flex justify-center pt-[148px]">
                            <?php
                            GlobalButton::render('primary', 'Book', '', '', '', 'submit', 'appointmentButton');
                            ?>
                        </div>
                </form>
            </div>
        </main>
<?php
    }
}

Page::page();
