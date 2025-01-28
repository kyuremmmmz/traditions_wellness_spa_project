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
        <div class='relative w-80 my-4'>
            <input type='{$this->type}' id='{$this->name}' name='{$this->name}' required placeholder=' ' 
                class='peer w-full h-12 px-3 bg-white border-2 border-gray-300 text-gray-900 outline-none rounded-md transition duration-300 
                focus:border-blue-500 focus:ring-blue-200' 
                oninput='handleInput(this)' />

            <label for='{$this->name}' 
                class='absolute left-3 top-0 transition-all duration-500 ease-out transform -translate-y-1/2 
                peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-gray-400 
                peer-focus:-translate-y-1/2 peer-focus:text-blue-500 peer-focus:text-sm 
                text-sm bg-white px-1 pointer-events-none origin-top-left'
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