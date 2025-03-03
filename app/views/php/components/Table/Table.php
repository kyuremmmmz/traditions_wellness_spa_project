<?php

namespace Project\App\Views\Php\Components\Table;

class Table
{
    public static function render(?string $className = null): void
    {
        $tableClasses = "min-w-full text-sm text-gray-700 $className";

        echo <<<HTML
        <div class="w-full overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-100 min-w-[300px]">
            <table class="$tableClasses">
                <thead class="text-xs uppercase bg-gradient-to-r from-indigo-600 to-indigo-500 text-white">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-semibold">Appt. ID</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Patient</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Date</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Time</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-indigo-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-center font-medium text-indigo-600">AP001</td>
                        <td class="px-6 py-4 text-center">Maria Santos</td>
                        <td class="px-6 py-4 text-center">2023-11-15</td>
                        <td class="px-6 py-4 text-center">9:00 AM</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Confirmed
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-indigo-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-center font-medium text-indigo-600">AP002</td>
                        <td class="px-6 py-4 text-center">Juan Dela Cruz</td>
                        <td class="px-6 py-4 text-center">2023-11-15</td>
                        <td class="px-6 py-4 text-center">10:30 AM</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        </td>
                    </tr>
                    <tr class="hover:bg-indigo-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-center font-medium text-indigo-600">AP003</td>
                        <td class="px-6 py-4 text-center">Ana Reyes</td>
                        <td class="px-6 py-4 text-center">2023-11-16</td>
                        <td class="px-6 py-4 text-center">2:00 PM</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Cancelled
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
HTML;
    }
}
