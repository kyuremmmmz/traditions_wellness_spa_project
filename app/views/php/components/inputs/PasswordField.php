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
        <div class='relative w-full my-4'>
            <input type='password' id='{$this->name}' name='{$this->name}' required placeholder=' ' 
                class='w-full h-12 px-3 pr-10 text-gray-900 transition duration-300 bg-white border-2 border-gray-300 rounded-md outline-none peer focus:border-blue-500'
                oninput='handlePasswordInput(this)' />

            <label for='{$this->name}' 
                class='absolute px-1 text-sm transition-all duration-500 ease-out origin-top-left transform -translate-y-1/2 bg-white pointer-events-none left-3 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-1/2 peer-focus:text-blue-500 peer-focus:text-sm'
                id='{$this->name}-label'>
                {$this->label}
            </label>

            <button type='button' onclick='togglePassword(\"{$this->name}\")' 
                class='absolute text-gray-500 transition-colors duration-300 -translate-y-1/2 right-3 top-1/2 hover:text-blue-500 focus:outline-none'>
                <i id='{$this->name}-icon' class='transition-all duration-300 fas fa-eye'></i>
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