<?php

namespace App\View\Components;

use Closure;
use App\Models\OfferCategory;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Footer extends Component
{
    /**
     * Create a new component instance.
     */
    public $categories;

    public function __construct($categories = [])
    {
        $this->categories = OfferCategory::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}