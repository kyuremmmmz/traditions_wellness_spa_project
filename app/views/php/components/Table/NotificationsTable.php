<?php

namespace Project\App\Views\Php\Components\Table;

use Project\App\Models\Utilities\NotificationsModel;

class NotificationsTable
{
    public static function render(?string $className = null): void
    {
        $containerClass = "border border-border dark:border-darkBorder border-[1px] rounded-[6px] w-[1000px] bg-background dark:bg-darkBackground p-4";
        $tableClass = "w-full border-collapse";
        $headerClass = "border-b-2 border-gray-300 dark:border-gray-700 text-left p-3 text-gray-900 dark:text-white font-semibold";
        $rowClass = "border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition";
        $cellClass = "p-3 text-gray-700 dark:text-gray-300";

        // Fetch notifications from the database
        $notificationsModel = new NotificationsModel();
        $notifications = $notificationsModel->getAllNotifications();

        echo <<<HTML
        <div class="$containerClass">
            <div class="mt-3">
                <table class="$tableClass">
                    <thead>
                        <tr>
                            <th class="$headerClass">Client Name</th>
                            <th class="$headerClass">Email</th>
                            <th class="$headerClass">Rating</th>
                            <th class="$headerClass">Date Posted</th>
                        </tr>
                    </thead>
                    <tbody>
        HTML;

        foreach ($notifications as $notif) {
            echo <<<HTML
                        <tr class="$rowClass">
                            <td class="$cellClass">{$notif['client_name']}</td>
                            <td class="$cellClass">{$notif['email']}</td>
                            <td class="$cellClass">{$notif['rating']}</td>
                            <td class="$cellClass">{$notif['date_posted']}</td>
                        </tr>
            HTML;
        }

        echo <<<HTML
                    </tbody>
                </table>
            </div>
        </div>
        HTML;
    }
}

// How to use:
// NotificationsTable::render();
?>
