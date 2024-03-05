<?php

namespace App\Livewire\LandingPage;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use App\Models\Kost;

class Index extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Landing Page')]

    #[Computed()]
    public function kosts(){
        return Kost::limit(6)->get();
    }

    public function render()
    {
        return view('livewire.landing-page.index');
    }
}
