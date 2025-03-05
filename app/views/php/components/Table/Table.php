<?php

namespace Project\App\Views\Php\Components\Table;

use Project\App\Controllers\Web\UseCases\AppointmentsController;

class Table
{
    public static function render(?string $className = null, string $id): void
    {
        $tableClasses = "min-w-full text-sm text-gray-700 table-fixed " . ($className ?? '');
        echo "<div class='w-full overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-100 min-w-[300px]'>";
        echo "<table class='$tableClasses'>";
        echo "<thead class='text-xs text-white uppercase bg-gradient-to-r from-indigo-600 to-indigo-500'>
                <tr>
                    <th scope='col' class='px-6 py-4 font-semibold'>#</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Appt. ID</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Phone Number</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Address</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Patient</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Date</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Start</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>End</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Total Price</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Hours</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Add-ons</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Status</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Service ID</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>User ID</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Status</th>
                    <th scope='col' class='px-6 py-4 font-semibold'>Action</th>
                </tr>
            </thead>";
        echo "<tbody id='$id' class='divide-y divide-gray-100'>";
        echo "</tbody></table></div>";
    }
}
