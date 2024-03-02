<?php

namespace App\Livewire\Setting\Profile;

use Livewire\Attributes\Title;
use Livewire\Component;

class Index extends Component
{
    #[Title('Profile')]

    public function render()
    {
        return view('livewire.setting.profile.index');
    }
}
