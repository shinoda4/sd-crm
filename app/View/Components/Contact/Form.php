<?php

namespace App\View\Components\Contact;

use App\Models\Contact;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public Contact $contact;

    /**
     * Create a new component instance.
     */
    public function __construct(?Contact $contact = null)
    {
        $this->contact = $contact ?? new Contact();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact.form');
    }
}
