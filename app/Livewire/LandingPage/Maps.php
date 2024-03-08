<?php

namespace App\Livewire\LandingPage;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Kost;

class Maps extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Maps')]

    public function mount(){
        $this->dispatch('data-kost', Kost::all());
    }

    public function render()
    {
        return view('livewire.landing-page.maps');
    }
}
