<?php

namespace App\View\Components\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthFrontend extends Component
{
    /**
     * Create a new component instance.
     */
    
    public $title = 'Authenticated';

    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.auth-frontend');
    }
}