<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class profileMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $username;
    public function __construct($username = 'def')
    {
        $this->username = $username;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile-menu');
    }
}
