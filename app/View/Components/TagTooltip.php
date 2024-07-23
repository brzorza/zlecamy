<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagTooltip extends Component
{
    /**
     * Create a new component instance.
     */
    public $tag;
    public $tooltip;

    public function __construct($tag, $tooltip=''){
        $this->tag = $tag;
        $this->tooltip = $tooltip;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.offer.tag-tooltip');
    }
}
