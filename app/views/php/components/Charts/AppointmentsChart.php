<?php

namespace Project\App\Views\Php\Components\Charts;

class AppointmentsChart
{
    public static function render($completedCount, $awaitingReviewCount, $ongoingCount, $upcomingCount, $pendingCount, $cancelledCount, $total): void
    {
        $dataSeries = json_encode([$completedCount, $awaitingReviewCount, $ongoingCount, $upcomingCount, $pendingCount, $cancelledCount]);

        echo <<<HTML
        <div class="relative w-[140px] h-[140px]">
            <div id="appointmentData" class="absolute inset-0" data-series='$dataSeries'></div>
            <div id="chart" class="absolute inset-0 flex items-center justify-center"></div>
            <div class="absolute inset-0 flex items-center justify-center flex-col gap-[4px]">
                <span class="HeaderOne text-onBackground dark:text-darkOnBackground leading-none" id="total">0</span>
                <span class="CaptionOne text-onBackground dark:text-darkOnBackground leading-none">Total</span>
            </div>
        </div>
        HTML;
    }
}