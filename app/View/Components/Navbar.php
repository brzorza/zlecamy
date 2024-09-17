<?php

namespace App\View\Components;

use Closure;
use App\Models\Notifications;
use App\Models\OfferCategory;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     */
    public $categories;
    public $notifications;

    public function __construct($categories = [], $notifications = [])
    {
        $this->categories = OfferCategory::all();
        $this->notifications = Notifications::where('user_id', auth()->id())->orderBy('created_at', 'desc')->limit(5)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
