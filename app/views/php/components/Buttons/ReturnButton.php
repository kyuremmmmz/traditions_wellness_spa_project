<?php
namespace Project\App\Views\Php\Components\Buttons;

class ReturnButton {
    private $text;
    private $type;
    private $color;
    private $size;
    private $showIcon;
    private $onclick;

    public function __construct(
        $text = 'Return to Login',
        $type = 'button',
        $color = '#09090B',
        $size = 16,
        $showIcon = true,
        $onclick = ''
    ) {
        $this->text = $text;
        $this->type = $type;
        $this->color = $color;
        $this->size = $size;
        $this->showIcon = $showIcon;
        $this->onclick = $onclick;
    }

    public function render() {
        $icon = $this->showIcon ? sprintf(
            '<svg xmlns="http://www.w3.org/2000/svg" width="%d" height="%d" viewBox="0 0 16 16" fill="none">
                <path d="M15 8H1" stroke="%s" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 15L1 8L8 1" stroke="%s" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>',
            $this->size,
            $this->size,
            $this->color,
            $this->color
        ) : '';

        return sprintf(
            '<button type="%s" class="flex items-center gap-2 transition-opacity hover:opacity-80" onclick="%s">
                %s
                <span class="font-inter text-[14px] font-normal leading-[150%%] tracking-[-0.308px]" style="color: %s">
                    %s
                </span>
            </button>',
            htmlspecialchars($this->type),
            htmlspecialchars($this->onclick),
            $icon,
            htmlspecialchars($this->color),
            htmlspecialchars($this->text)
        );
    }
}
?>