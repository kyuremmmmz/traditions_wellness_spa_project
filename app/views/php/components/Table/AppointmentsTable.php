<?php

namespace Project\App\Views\Php\Components\Table;

class AppointmentsTable
{
    public static function render(string $id, ?string $className = null): void
    {
        $tableClasses = "w-full text-sm text-gray-700 table-fixed" . ($className ?? '');
        echo "<div class='w-full overflow-x-auto bg-white min-w-[300px] h-[400px] overflow-y-auto'>";
        echo "<table class='$tableClasses'>";
        echo "<thead class='text-onBackgroundTwo dark:text-darkOnBackgroundTwo uppercase bg-[#FFEA06] bg-opacity-5 tracking-wider px-[48px] mx-[48px]'>
                <tr>
                    <th scope='col' class='pl-[48px] pr-[8px] py-4 CaptionTwo w-[72px] text-center'>No.</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[160px] text-center'>client name</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[160px] text-center'>service booked</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[80px] text-center'>party size</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[160px]'>assigned therapist</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[80px]'>Bed No.</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[120px]'>Scheduled Date</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[80px]'>Start Time</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[80px]'>Duration</th>
                    <th scope='col' class='pr-[48px] pl-[8px] CaptionTwo py-4 w-[80px]'>Status</th>
                </tr>
            </thead>";
        echo "<tbody id='$id' class='divide-y divide-gray-100'>";
        echo "</tbody></table></div>";
    }
}
