<?php
namespace Project\App\Views\Php\Components\Inputs;

class InputField {
    private $name;
    private $label;
    private $type;
    private $error;

    public function __construct($name, $label, $type = "text", $error = null) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->error = $error;
    }

    public function render() {
        $borderColor = $this->error ? 'border-red-500 shadow-[0_0_8px_2px_rgba(239,68,68,0.3)]' : 'border-gray-300';
        $focusBorder = $this->error ? 'focus:border-red-500' : 'focus:border-blue-500';
        $focusRing = $this->error ? 'focus:ring-red-200' : 'focus:ring-blue-200';
        $bg = "bg-background";


        $emailAttributes = '';
        if ($this->type === 'email') {
            $emailAttributes = 'pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Please enter a valid email address."';
        }

        return "
        <div class='relative w-full my-4 bg-background'>
            <input type='{$this->type}' id='{$this->name}' name='{$this->name}' required placeholder=' ' 
                class='peer bg-background w-[314px] h-[40px] px-3 border-[1px] border-border.2 text-on.background outline-none rounded-[6px] transition duration-300 
                {$focusBorder} {$focusRing}'
                oninput='handleInput(this)'
                style='bg-color: {$bg}'
                {$emailAttributes} />

            <label for='{$this->name}'
                class='absolute bg-background left-3 top-0 transition-all duration-500 ease-out transform -translate-y-1/2
                peer-placeholder-shown:translate-y-3 peer-placeholder-shown:text-gray-400
                peer-focus:-translate-y-1/2 peer-focus:text-[#09090B] peer-focus:text-sm
                text-sm px-1 pointer-events-none origin-top-left'
                id='{$this->name}-label'>
                {$this->label}
            </label>

            " . ($this->error ? "
            <div class='mt-1 text-sm text-red-500'>
                {$this->error}
            </div>" : "") . "
        </div>

        <script>
            function handleInput(input) {
                const label = document.getElementById(input.id + '-label');
                if (input.value.trim() !== '') {
                    label.classList.add('text-sm', '-translate-y-1/2');
                    label.style.color = '#09090B';
                    label.classList.remove('text-gray-400', 'peer-placeholder-shown:translate-y-3');
                } else {
                    label.classList.remove('text-sm', '-translate-y-1/2');
                    label.style.color = '';
                    label.classList.add('text-gray-400', 'peer-placeholder-shown:translate-y-3');
                }
            }
        </script>
        ";
    }
}