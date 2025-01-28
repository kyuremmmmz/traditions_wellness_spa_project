<?php
namespace Project\App\Views\Php\Components\Inputs;

class InputField {
    private $name;
    private $label;
    private $type;

    public function __construct($name, $label, $type = "text") {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
    }
    public function render() {
        return "
        <div class='relative w-full my-4'>
            <input type='{$this->type}' id='{$this->name}' name='{$this->name}' required placeholder=' ' 
                class='w-full h-12 px-3 text-gray-900 transition duration-300 bg-white border-2 border-gray-300 rounded-md outline-none peer focus:border-blue-500 focus:ring-blue-200' 
                oninput='handleInput(this)' />

            <label for='{$this->name}' 
                class='absolute top-0 px-1 text-sm transition-all duration-500 ease-out origin-top-left transform -translate-y-1/2 bg-white pointer-events-none left-3 peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-gray-400 peer-focus:-translate-y-1/2 peer-focus:text-blue-500 peer-focus:text-sm'
                id='{$this->name}-label'>
                {$this->label}
            </label>
        </div>

        <script>
            function handleInput(input) {
                const label = document.getElementById(input.id + '-label');
                if (input.value.trim() !== '') {
                    label.classList.add('text-blue-500', 'text-sm', '-translate-y-1/2');
                    label.classList.remove('text-gray-400', 'peer-placeholder-shown:translate-y-3');
                } else {
                    label.classList.remove('text-blue-500', 'text-sm', '-translate-y-1/2');
                    label.classList.add('text-gray-400', 'peer-placeholder-shown:translate-y-3');
                }
            }
        </script>
        ";
    }
}
?>