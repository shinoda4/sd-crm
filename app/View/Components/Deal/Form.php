<?php

namespace App\View\Components\Deal;

use App\Models\Deal;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public Deal $deal;

    /**
     * Create a new component instance.
     */
    public function __construct(?Deal $deal = null)
    {
        $this->deal = $deal ?? new Deal();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.deal.form');
    }
}
