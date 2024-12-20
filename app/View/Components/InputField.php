<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputField extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $name;
    public $value;
    public $label;
    public $placeholder;
    public $classes;
    public $divClasses;
    public $max;
    public $labelclasses;

    public function __construct($type = 'text', $name, $value = '', $label = '', $placeholder = '', $classes = '', $divClasses = '', $max='', $labelclasses=''){
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->classes = $classes;
        $this->divClasses = $divClasses;
        $this->max = $max;
        $this->labelclasses = $labelclasses;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-field');
    }
}
