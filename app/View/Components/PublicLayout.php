<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PublicLayout extends Component
{
    public ?string $profileBg;
    public ?string $profileText;

    /**
     * Create a new component instance.
     */
    public function __construct(?string $profileBg = null, ?string $profileText = null)
    {
        $this->profileBg = $profileBg;
        $this->profileText = $profileText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.public');
    }
}
