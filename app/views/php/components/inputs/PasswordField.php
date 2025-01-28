<?php
namespace Project\App\Views\Php\Components\Inputs;

class PasswordField {
    private $name;
    private $label;

    public function __construct($name = "password", $label = "Password") {
        $this->name = $name;
        $this->label = $label;
    }

    public function render() {
        return "
        <div class='relative w-80 my-4'>
            <input type='password' id='{$this->name}' name='{$this->name}' required placeholder=' ' 
                class='peer w-full h-12 px-3 pr-10 bg-white border-2 border-gray-300 text-gray-900 outline-none rounded-md transition duration-300
                focus:border-blue-500'
                oninput='handlePasswordInput(this)' />

            <label for='{$this->name}' 
                class='absolute left-3 transition-all duration-500 ease-out transform -translate-y-1/2 
                peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-gray-400 
                peer-focus:-translate-y-1/2 peer-focus:text-blue-500 peer-focus:text-sm
                text-sm bg-white px-1 pointer-events-none origin-top-left'
                id='{$this->name}-label'>
                {$this->label}
            </label>

            <button type='button' onclick='togglePassword(\"{$this->name}\")' 
                class='absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-blue-500 
                focus:outline-none transition-colors duration-300'>
                <i id='{$this->name}-icon' class='fas fa-eye transition-all duration-300'></i>
            </button>

            <script>
                function handlePasswordInput(input) {
                    const label = document.getElementById(input.id + '-label');
                    if (input.value.trim() !== '') {
                        label.classList.add('text-blue-500', 'text-sm', '-translate-y-1/2');
                        label.classList.remove('text-gray-400', 'peer-placeholder-shown:translate-y-3');
                    } else {
                        label.classList.remove('text-blue-500', 'text-sm', '-translate-y-1/2');
                        label.classList.add('text-gray-400', 'peer-placeholder-shown:translate-y-3');
                    }
                }

                function togglePassword(inputId) {
                    const passwordInput = document.getElementById(inputId);
                    const eyeIcon = document.getElementById(inputId + '-icon');
                    passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
                    eyeIcon.classList.toggle('fa-eye-slash');
                    passwordInput.focus();
                }
            </script>
        </div>";
    }
}
?>