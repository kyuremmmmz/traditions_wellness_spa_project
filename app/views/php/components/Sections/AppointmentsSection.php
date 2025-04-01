<?php

namespace Project\App\Views\Php\Components\Sections;

use Project\App\Views\Php\Components\Charts\AppointmentsChart;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Table\AppointmentsTable;
use Project\App\Views\Php\Components\Texts\CountDisplayer;

class AppointmentsSection
{
    public static function render(): void
    {
        ?>
        <div id="main" class="">
            <div class="max-w-full flex flex-col items-start overflow-x-auto">
                <div class="border border-border border-[1px] dark:border-darkBorder rounded-[6px] max-w-full overflow-x-auto">
                    <table class="bg-background dark:bg-darkBackground" style="border-radius: 6px; overflow: hidden; border-collapse: collapse; margin: 0; padding: 0;">
                        <tr class="p-0 m-0" style="margin: 0; padding: 0;">
                            <td class="flex p-0 m-0 sm:w-full">
                                <section class="p-[48px] w-[240px] flex flex-col gap-[16px]">
                                    <?php AppointmentsChart::render();  ?>
                                    <div class="flex flex-col gap-[8px] pl-[24px]">
                                        <?php
                                        CountDisplayer::render('success', 0, 'Completed', 'completed', '');
                                        CountDisplayer::render('blue', 0, 'Awaiting Review', 'review', '');
                                        CountDisplayer::render('orange', 0, 'Ongoing', 'ongoing', '');
                                        CountDisplayer::render('yellow', 0, 'Upcoming', 'upcoming', '');
                                        CountDisplayer::render('onBackgroundTwo', 0, 'Pending', 'pending', '');
                                        CountDisplayer::render('destructive', 0, 'Canceled', 'cancelled', '');
                                        ?>
                                    </div>
                                </section>
                                <div class="overflow-x-auto border-l border-border dark:border-darkBorder">
                                    <section class="p-[48px] flex gap-[16px] bg-[#FFEA06] bg-opacity-5">
                                        <?php
                                        SecondaryInputField::render('dropdownfield', 'Filter status by', '', ['All', 'Completed', 'Awaiting Review', 'Ongoing', 'Upcoming', 'Pending', 'Canceled']);
                                        SecondaryInputField::render('datefield', 'Show appointments from', '');
                                        ?>
                                    </section>
                                    <section class="max-w-[1120px]">
                                        <?php AppointmentsTable::render('appointmentsTable', ''); ?>
                                    </section>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/charts/appointmentsChart.js"></script>
        <?php 
    }
}