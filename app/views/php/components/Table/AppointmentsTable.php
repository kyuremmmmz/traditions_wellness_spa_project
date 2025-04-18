<?php

namespace Project\App\Views\Php\Components\Table;

class AppointmentsTable
{
    public static function render(string $id, ?string $className = null): void
    {
        $tableClasses = "w-full table-fixed overflow-x-auto" . ($className ?? '');
        echo "<div class='w-full overflow-x-auto bg-background dark:bg-darkBackground min-w-[300px] h-[500px] overflow-y-auto overflow-x-auto'>";
        echo "<table class='$tableClasses'>";
        echo "<thead class='text-onBackgroundTwo dark:text-darkOnBackgroundTwo uppercase bg-[#FFEA06] bg-opacity-5 tracking-wider px-[48px] mx-[48px] overflow-x-auto'>
                <tr>
                    <th scope='col' class='pl-[48px] pr-[8px] py-4 CaptionTwo w-[72px] text-center'>No.</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[160px] text-center'>client name</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[160px] text-center'>service booked</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[80px] text-center'>party size</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[160px]'>email</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[80px]'>Gender</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[120px]'>Scheduled Date</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[80px]'>Start Time</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[80px]'>Duration</th>
                    <th scope='col' class='pr-[48px] pl-[8px] CaptionTwo py-4 w-[128px]'>Status</th>
                </tr>
            </thead>";
        echo "<tbody id='$id' class='divide-y divide-gray-100'>";
        echo "</tbody></table></div>";
    }
}
