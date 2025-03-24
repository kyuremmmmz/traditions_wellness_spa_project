<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Charts\AppointmentsChart;
use Project\App\Views\Php\Components\Texts\CountDisplayer;

class Page
{
    public static function page()
    {
                $completedCount = '5';
                $awaitingReviewCount = '3';
                $ongoingCount = '9';
                $upcomingCount = '5';
                $pendingCount = '2';
                $cancelledCount = '2';
                $total = $completedCount + $awaitingReviewCount + $ongoingCount + $upcomingCount + $pendingCount + $cancelledCount;
                // Define variables needed throughout the page
                $currentYear = date('Y');
                $months = [
                    1 => 'January', 2 => 'February', 3 => 'March',
                    4 => 'April', 5 => 'May', 6 => 'June',
                    7 => 'July', 8 => 'August', 9 => 'September',
                    10 => 'October', 11 => 'November', 12 => 'December'
                ];
                ?>
                <main class="flex w-full gap-4 overflow-y-auto">
                    <?php Sidebar::render();      
                    ?>
                    <div id="main" class="sm:ml-[48px] overflow-y-auto sm:px-[0px] sm:pt-[128px] pt-0 sm:pb-[128px] pb-0 pl-[48px] flex flex-col mt-[104px] sm:mt-[0px] sm:items-center sm:justify-top sm:h-screen w-full">
                        <div class="flex flex-col gap-[24px]">
                            <section class="flex h-[50px]">
                                <div class="min-w-[50px] min-h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground transition-all rounded-[6px] flex justify-center items-center">
                                    <?php IconChoice::render('dashboardMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                                </div>
                                <div class="h-full flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[16px] gap-[4px]">
                                    <?php echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Dashboard');
                                    echo LastUpdated::render(); ?>
                                </div>
                            </section>
                            <div class="flex flex-col sm:flex-row gap-[24px] sm:gap-[32px]">
                                <section class="flex flex-col gap-[16px]">
                                    <div class="flex justify-between items-end w-full gap-2">
                                        <?php Text::render('', '', 'BodyOne text-onBackground dark:text-darkOnBackground leading-none', 'Today\'s Appointments');?>
                                    </div>
                                    <div class="p-[48px] flex items-center justify-between w-[412px] rounded-[6px] border border-border dark:border-darkBorder">
                                        <div class="flex flex-col gap-[8px]">
                                            <?php
                                            CountDisplayer::render('success', 0, 'Completed', 'completed', '');
                                            CountDisplayer::render('blue', 0, 'Awaiting Review', 'review', '');
                                            CountDisplayer::render('orange', 0, 'Ongoing', 'ongoing', '');
                                            CountDisplayer::render('yellow', 0, 'Upcoming', 'upcoming', '');
                                            CountDisplayer::render('onBackgroundTwo', 0, 'Pending', 'pending', '');
                                            CountDisplayer::render('destructive', 0, 'Canceled', 'cancelled', '');
                                            ?>
                                        </div>
                                        <?php AppointmentsChart::render($completedCount, $awaitingReviewCount, $ongoingCount, $upcomingCount, $pendingCount, $cancelledCount, $total);  ?>
                                    </div>
                                </section>
                                
                                <section class="flex flex-col overflow-x-auto gap-4">
                                    <div class="flex justify-between items-end w-full gap-2">
                                        <?php Text::render('', '', 'BodyOne text-onBackground dark:text-darkOnBackground leading-none', 'Revenue Tracker');?>
                                    </div>
                                    
                                    <!-- Charts container -->
                                    <div class="charts-container w-[1000px] rounded-[6px] border border-border dark:border-darkBorder">
                                        <!-- Filters -->
                                        <div class="flex justify-between gap-[16px] p-[48px]">
                                            <div class='relative min-w-[100px] max-w-[190px]'>
                                                <?php IconChoice::render('chevronRightSmall', '[12px]', '[12px] absolute right-[16px] top-[9px] -rotate-90', '', 'onSurface', 'darkOnSurface'); ?>
                                                <label for="viewTypeSelector" class="BodyTwo leading-none text-onBackground dark:text-darkOnBackground pr-[16px]">View Type</label>
                                                <select id="viewTypeSelector" class="BodyTwo leading-none h-[30px] px-3 w-[100px] appearance-none rounded-[6px] border border-border dark:border-darkBorder bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground">
                                                    <option value="weekly" selected>Weekly</option>
                                                    <option value="monthly">Monthly</option>
                                                    <option value="yearly">Yearly</option>
                                                </select>
                                            </div>

                                            <!-- Yearly filter -->
                                            <div id="yearlyFilters" class="flex gap-2 items-end">
                                                <div class='relative min-w-[100px]'>
                                                    <?php IconChoice::render('chevronRightSmall', '[12px]', '[12px] absolute right-[16px] top-[9px] -rotate-90', '', 'onSurface', 'darkOnSurface'); ?>
                                                    <label for="yearSelector" class="BodyTwo leading-none text-onBackground dark:text-darkOnBackground pr-[16px]">Year</label>
                                                    <select id="yearSelector" class="BodyTwo leading-none px-3 w-[100px] h-[30px] py-1 appearance-none rounded-[6px] border border-border dark:border-darkBorder bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground">
                                                        <?php
                                                        for ($year = $currentYear; $year >= $currentYear - 4; $year--) {
                                                            echo "<option value='$year'>$year</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Monthly filters -->
                                            <div id="monthlyFilters" class="flex gap-[24px]" style="display: none;">
                                                <div class='relative min-w-[120px]'>
                                                    <?php IconChoice::render('chevronRightSmall', '[12px]', '[12px] absolute right-[16px] top-[9px] -rotate-90', '', 'onSurface', 'darkOnSurface'); ?>
                                                    <label for="monthSelector" class="BodyTwo leading-none text-onBackground dark:text-darkOnBackground pr-[16px]">Month</label>
                                                    <select id="monthSelector" class="BodyTwo leading-none h-[30px] px-3 w-[100px] py-1 appearance-none rounded-[6px] border border-border dark:border-darkBorder bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground">
                                                        <?php
                                                        foreach ($months as $num => $name) {
                                                            $selected = $num === (int)date('m') ? 'selected' : '';
                                                            echo "<option value='$num' $selected class='BodyTwo leading-none'>$name</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class='relative min-w-[100px]'>
                                                    <?php IconChoice::render('chevronRightSmall', '[12px]', '[12px] absolute right-[16px] top-[9px] -rotate-90', '', 'onSurface', 'darkOnSurface'); ?>
                                                    <label for="monthlyYearSelector" class="BodyTwo leading-none text-onBackground dark:text-darkOnBackground pr-[16px]">Year</label>
                                                    <select id="monthlyYearSelector" class="BodyTwo leading-none px-3 h-[30px] w-[80px] py-1 appearance-none rounded-[6px] border border-border dark:border-darkBorder bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground">
                                                        <?php
                                                        for ($year = $currentYear; $year >= $currentYear - 4; $year--) {
                                                            echo "<option value='$year'>$year</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Weekly filters -->
                                            <div id="weeklyFilters" class="flex gap-[24px]" style="display: none;">
                                                <div class='relative min-w-[100px]'>
                                                    <?php IconChoice::render('chevronRightSmall', '[12px]', '[12px] absolute right-[16px] top-[9px] -rotate-90', '', 'onSurface', 'darkOnSurface'); ?>
                                                    <label for="weekSelector" class="BodyTwo leading-none text-onBackground dark:text-darkOnBackground pr-[16px]">Week</label>
                                                    <select id="weekSelector" class="BodyTwo leading-none h-[30px]  px-3 w-[100px] py-1 appearance-none rounded-[6px] border border-border dark:border-darkBorder bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground">
                                                        <option value="1">Week 1</option>
                                                        <option value="2">Week 2</option>
                                                        <option value="3">Week 3</option>
                                                        <option value="4">Week 4</option>
                                                    </select>
                                                </div>
                                                <div class='relative min-w-[120px]'>
                                                    <?php IconChoice::render('chevronRightSmall', '[12px]', '[12px] absolute right-[16px] top-[9px] -rotate-90', '', 'onSurface', 'darkOnSurface'); ?>
                                                    <label for="weeklyMonthSelector" class="BodyTwo leading-none text-onBackground dark:text-darkOnBackground pr-[16px]">Month</label>
                                                    <select id="weeklyMonthSelector" class="BodyTwo leading-none h-[30px] px-3 w-[100px] py-1 appearance-none rounded-[6px] border border-border dark:border-darkBorder bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground">
                                                        <?php
                                                        $months = [
                                                            1 => 'January', 2 => 'February', 3 => 'March',
                                                            4 => 'April', 5 => 'May', 6 => 'June',
                                                            7 => 'July', 8 => 'August', 9 => 'September',
                                                            10 => 'October', 11 => 'November', 12 => 'December'
                                                        ];
                                                        foreach ($months as $num => $name) {
                                                            $selected = $num === (int)date('m') ? 'selected' : '';
                                                            echo "<option value='$num' $selected class='BodyTwo leading-none'>$name</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class='relative min-w-[100px]'>
                                                    <?php IconChoice::render('chevronRightSmall', '[12px]', '[12px] absolute right-[16px] top-[9px] -rotate-90', '', 'onSurface', 'darkOnSurface'); ?>
                                                    <label for="weeklyYearSelector" class="BodyTwo leading-none text-onBackground dark:text-darkOnBackground pr-[16px]">Year</label>
                                                    <select id="weeklyYearSelector" class="BodyTwo leading-none px-3 h-[30px] w-[80px] py-1 appearance-none rounded-[6px] border border-border dark:border-darkBorder bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground">
                                                        <?php
                                                        $currentYear = date('Y');
                                                        for ($year = $currentYear; $year >= $currentYear - 4; $year--) {
                                                            echo "<option value='$year'>$year</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <!-- Revenue Information -->
                                        <div class="flex gap-[24px]">
                                            <!-- Weekly Revenue -->
                                            <div id="weekly_revenue_info" class="flex flex-col gap-[4px] px-[48px]">
                                                <?php Text::render('weekly_caption', '', 'CaptionOne text-onBackground dark:text-darkOnBackground leading-none', "This week's total revenue");?>
                                                <?php Text::render('weekly_revenue', '', 'BodyMediumOne text-primary dark:text-darkPrimary leading-none', '₱0');?>
                                            </div>

                                            <!-- Monthly Revenue -->
                                            <div id="monthly_revenue_info" class="flex flex-col gap-[4px] px-[48px]" style="display: none;">
                                                <?php Text::render('monthly_caption', '', 'CaptionOne text-onBackground dark:text-darkOnBackground leading-none', "This month's total revenue");?>
                                                <?php Text::render('monthly_revenue', '', 'BodyMediumOne text-primary dark:text-darkPrimary leading-none', '₱0');?>
                                            </div>

                                            <!-- Yearly Revenue -->
                                            <div id="yearly_revenue_info" class="flex flex-col gap-[4px] px-[48px]" style="display: none;">
                                                <?php Text::render('yearly_caption', '', 'CaptionOne text-onBackground dark:text-darkOnBackground leading-none', "This year's total revenue");?>
                                                <?php Text::render('yearly_revenue', '', 'BodyMediumOne text-primary dark:text-darkPrimary leading-none', '₱0');?>
                                            </div>

                                            <!-- Most popular service -->
                                            <!-- Weekly Popular Service -->
                                            <div id="weekly_popular_info" class="flex flex-col gap-[4px] px-[48px]">
                                                <?php Text::render('weekly_popular_caption', '', 'CaptionOne text-onBackground dark:text-darkOnBackground leading-none', "This week's most popular service");?>
                                                <?php Text::render('weekly_popular_service', '', 'BodyMediumOne text-primary dark:text-darkPrimary leading-none', 'sample');?>
                                            </div>

                                            <!-- Monthly Popular Service -->
                                            <div id="monthly_popular_info" class="flex flex-col gap-[4px] px-[48px]" style="display: none;">
                                                <?php Text::render('monthly_popular_caption', '', 'CaptionOne text-onBackground dark:text-darkOnBackground leading-none', "This month's most popular service");?>
                                                <?php Text::render('monthly_popular_service', '', 'BodyMediumOne text-primary dark:text-darkPrimary leading-none', 'sample');?>
                                            </div>

                                            <!-- Yearly Popular Service -->
                                            <div id="yearly_popular_info" class="flex flex-col gap-[4px] px-[48px]" style="display: none;">
                                                <?php Text::render('yearly_popular_caption', '', 'CaptionOne text-onBackground dark:text-darkOnBackground leading-none', "This year's most popular service");?>
                                                <?php Text::render('yearly_popular_service', '', 'BodyMediumOne text-primary dark:text-darkPrimary leading-none', 'sample');?>
                                            </div>

                                        </div>


                                        <!-- Revenue Chart -->
                                        <div id="chart-wrapper" class="relative w-full h-[400px]">
                                            <div id="weeklyChart" class="absolute top-0 left-0 w-full h-full bg-background dark:bg-darkBackground  p-4 overflow-x-auto" style="display: none;"></div>
                                            <div id="monthlyChart" class="absolute top-0 left-0 w-full h-full bg-background dark:bg-darkBackground rounded-[6px]  p-4 overflow-x-auto" style="display: none;"></div>
                                            <div id="stackedColumnChart" class="absolute top-0 left-0 w-full h-full bg-background dark:bg-darkBackground rounded-[6px]  p-4 overflow-x-auto"></div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </main>
                <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/dashboard/ChartSelector.js"></script>
                <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/dashboard/RevenueChart.js"></script>
                <script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/charts/appointmentsChart.js"></script>

        <?php
    }
}

Page::page();
