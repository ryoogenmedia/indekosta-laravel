<?php

namespace App\Livewire\LandingPage;


use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class DetailKost extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Detail Kost')]

    public function render()
    {
        return view('livewire.landing-page.detail-kost');
    }
}
