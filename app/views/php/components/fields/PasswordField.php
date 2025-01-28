<?php

namespace Project\App\Views\Php\Components\Fields;

class PasswordField
{
    public static function render(?string $className = null): void
    {
        // Render the component starting with a <div>
        $classAttribute = $className ? " class=\"$className\"" : '';
        echo <<<HTML
        <div{$classAttribute}>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" autocomplete="current-password" required
                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
        </div>
        HTML;
    }
}