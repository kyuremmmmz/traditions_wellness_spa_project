<?php

namespace Project\App\Views\Php\Components\Table;

class NotificationsTable
{
    public static function render(?string $className = null): void
    {
        $containerClass = "border border-border dark:border-darkBorder border-[1px] rounded-[6px] w-[1000px] bg-background dark:bg-darkBackground p-4";
        $notificationItemClass = "flex items-center justify-between p-3 border-b last:border-b-0 hover:bg-gray-100 dark:hover:bg-gray-800 transition";
        
        $notifications = [
            ["icon" => "👤", "title" => "New User Registered", "description" => "A new user, John Doe, has signed up.", "time" => "10 minutes ago"],
            ["icon" => "⚠️", "title" => "Reported Content", "description" => "A post has been flagged for review.", "time" => "1 hour ago"],
            ["icon" => "🔄", "title" => "System Update", "description" => "A new security patch has been installed.", "time" => "5 hours ago"],
            ["icon" => "🔑", "title" => "Suspicious Login Attempt", "description" => "An unsuccessful login attempt was detected.", "time" => "1 day ago"],
        ];

        echo <<<HTML
        <div class="$containerClass">
            <div class="mt-3 divide-y">
        HTML;

        foreach ($notifications as $notif) {
            echo <<<HTML
                <div class="$notificationItemClass">
                    <div class="flex items-center space-x-3">
                        <span class="text-gray-700 dark:text-gray-300">{$notif['icon']}</span>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{$notif['title']}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{$notif['description']}</p>
                        </div>
                    </div>
                    <span class="text-xs text-gray-400">{$notif['time']}</span>
                </div>
            HTML;
        }

        echo "</div></div>";
    }
}

// How to use:
// NotificationsTable::render();
?>
