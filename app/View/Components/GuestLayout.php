<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Indica si el diseño se renderiza crudo/completo o en caja centrada.
     */
    public bool $raw;

    /**
     * Create a new component instance.
     */
    public function __construct(bool $raw = false)
    {
        $this->raw = $raw;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
