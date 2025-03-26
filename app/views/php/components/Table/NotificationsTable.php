<?php

namespace Project\App\Views\Php\Components\Table;

use Project\App\Models\Utilities\NotificationsModel;

class NotificationsTable
{
    public static function render(?string $className = null): void
    {
        $containerClass = "border border-border dark:border-darkBorder border-[1px] rounded-[6px] w-[800px] bg-background dark:bg-darkBackground p-4";
        $tableClass = "w-full border-collapse";
        $headerClass = "border-b-2 border-gray-300 dark:border-gray-700 text-left p-3 text-gray-900 dark:text-white font-semibold";
        $rowClass = "border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition";
        $cellClass = "p-3 text-gray-700 dark:text-gray-300";

        $notifications = [];
        echo <<<HTML
        <div class="$containerClass">
            <h2 class="text-lg font-semibold mb-3">Notifications</h2>
            <table class="$tableClass">
                <thead>
                    <tr>
                        <th class="$headerClass">Message</th>
                        <th class="$headerClass">Status</th>
                        <th class="$headerClass">Date</th>
                    </tr>
                </thead>
                <tbody>
        HTML;

        foreach ($notifications as $notif) {
            $statusBadge = $notif['status'] === 'unread' 
                ? "<span class='text-red-500 font-semibold'>Unread</span>" 
                : "<span class='text-green-500'>Read</span>";

            echo <<<HTML
                    <tr class="$rowClass">
                        <td class="$cellClass">{$notif['message']}</td>
                        <td class="$cellClass">$statusBadge</td>
                        <td class="$cellClass">{$notif['created_at']}</td>
                    </tr>
            HTML;
        }

        echo <<<HTML
                </tbody>
            </table>
        </div>
        HTML;
    }
}

// Usage example:
// NotificationsTable::render($userId);