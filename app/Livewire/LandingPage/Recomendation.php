<?php

namespace App\Livewire\LandingPage;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Recomendation extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Rekomendasi')]

    public function render()
    {
        return view('livewire.landing-page.recomendation');
    }
}
