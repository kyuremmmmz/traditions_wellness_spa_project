<?php

class Component {
    /**
     * Render an input field with Tailwind classes
     */
    public static function inputField($type = "text", $name = "input", $label = "Enter Text", $value = "", $placeholder = " ") {
        $id = "input_" . $name;

        echo '
        <div class="flex flex-col w-full max-w-md">
            <label for="' . $id . '" class="text-sm font-medium text-gray-700">' . htmlspecialchars($label) . '</label>
            <input type="' . htmlspecialchars($type) . '" 
                   name="' . htmlspecialchars($name) . '" 
                   id="' . $id . '"
                   value="' . htmlspecialchars($value) . '" 
                   placeholder="' . htmlspecialchars($placeholder) . '" 
                   class="w-[316px] h-[40px] px-4 py-2 border rounded-[6px] text-gray-900 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 placeholder-onbackground2"
                   required>
        </div>';
    }

    /**
     * Render a password input field with Tailwind classes and toggle button
     */
    public static function passwordField($name = "password", $label = "Enter Your Password") {
        $id = "input_" . $name;

        echo '
        <div class="relative flex flex-col w-full max-w-md">
            <label for="' . $id . '" class="text-sm font-medium text-gray-700">' . htmlspecialchars($label) . '</label>
            <div class="relative">
                <input type="password" 
                       name="' . htmlspecialchars($name) . '" 
                       id="' . $id . '" 
                       placeholder=" " 
                       class="w-full px-4 py-2 border rounded-lg text-gray-900 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                       required>
                <button type="button" onclick="togglePassword(\'' . $id . '\')" class="absolute right-3 top-3 text-gray-500">
                    <i id="eye-icon-' . $id . '" class="fas fa-eye"></i>
                </button>
            </div>
        </div>';
    }
}
?>
