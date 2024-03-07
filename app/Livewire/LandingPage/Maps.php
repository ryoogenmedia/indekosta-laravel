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

    #[Computed]
    public function kost(){
        return Kost::all();
    }
    
    public function render()
    {
        return view('livewire.landing-page.maps');
    }
}
