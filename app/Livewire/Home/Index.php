<?php

namespace App\Livewire\Home;

use App\Helpers\HomeChart;
use App\Models\Kost;
use App\Models\Recomendation;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $jmlKost;
    public $jmlRekomendasi;
    public $jmlPengguna;

    public $rekomendasi;
    public $kost;

    public function mount()
    {
        $user = auth()->user();

        if ($user->roles == 'admin') {
            $this->jmlKost = Kost::count();
            $this->jmlRekomendasi = Recomendation::count();
            $this->jmlPengguna = User::count();

            $this->rekomendasi = HomeChart::RECOMENDATION();
            $this->kost = HomeChart::RECOMENDATION();
        }
    }

    public function render()
    {
        return view('livewire.home.index');
    }
}
