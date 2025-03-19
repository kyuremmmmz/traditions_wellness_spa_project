<?php

namespace Project\App\Views\Php\Components\Table;

class TherapistsTable
{
    public static function render(string $id, ?string $className = null): void
    {
        $tableClasses = "w-full table-fixed" . ($className ?? '');
        echo "<div class='w-full overflow-x-auto bg-background dark:bg-darkBackground min-w-[300px] h-[400px] overflow-y-auto'>";
        echo "<table class='$tableClasses'>";
        echo "<thead class='text-onBackgroundTwo dark:text-darkOnBackgroundTwo uppercase bg-[#FFEA06] bg-opacity-5 tracking-wider px-[48px] mx-[48px]'>
                <tr>
                    <th scope='col' class='pl-[48px] pr-[8px] py-4 CaptionTwo w-[72px] text-center'>No.</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[160px] text-center'>Therapist name</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[160px] text-center'>Status</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[80px] text-center'>Gender</th>
                    <th scope='col' class='py-4 px-[8px] CaptionTwo w-[160px]'>email</th>
                </tr>

                

                
            </thead>";
        echo "<tbody id='$id' class='divide-y divide-gray-100'>";
        echo "</tbody></table></div>";
    }

}