<?php

namespace Project\App\Views\Php\Components\Table;

class Table
{
    public static function render(?string $className = null, string $id): void
    {
        $tableClasses = "min-w-full text-sm text-gray-700 table-fixed $className";

        echo <<<HTML
        <div class="w-full overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-100 min-w-[300px]">
            <table class="$tableClasses">
                <thead class="text-xs text-white uppercase bg-gradient-to-r from-indigo-600 to-indigo-500">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-semibold">Appointments</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Appt. ID</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Phone Number</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Address</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Patient</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Date</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Start</th>
                        <th scope="col" class="px-6 py-4 font-semibold">End</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Total price</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Status</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody id="{$id}" class="divide-y divide-gray-100">
                    <tr class="transition-colors duration-200 hover:bg-indigo-50">
                        <td class="px-6 py-4 font-medium text-center text-indigo-600">AP001</td>
                        <td class="px-6 py-4 text-center">Maria Santos</td>
                        <td class="px-6 py-4 text-center">2023-11-15</td>
                        <td class="px-6 py-4 text-center">9:00 AM</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Confirmed
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button class="px-3 py-1 mr-2 text-xs font-medium text-white bg-blue-500 rounded hover:bg-blue-600">Update</button>
                            <button class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded hover:bg-red-600">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
HTML;
    }
}
