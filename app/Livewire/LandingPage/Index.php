<?php

namespace App\Livewire\LandingPage;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Index extends Component
{
    #[Layout('layouts.landing-page')]
    public function render()
    {
        return view('livewire.landing-page.index');
    }
}
