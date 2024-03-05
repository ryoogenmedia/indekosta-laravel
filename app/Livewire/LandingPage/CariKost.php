<?php

namespace App\Livewire\LandingPage;

use Livewire\Component;
use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use App\Models\Kost;

class CariKost extends Component
{
    use WithBulkActions;
    use WithPerPagePagination;
    use WithCachedRows;
    use WithSorting;

    #[Layout('layouts.landing-page')]
    #[Title('Cari Kost')]

    public $search = '';

    public function mount(){
        $this->perPage = 6;
    }

    #[Computed()]
    public function rows()
    {
        $query = Kost::query()
            ->when(!$this->sorts, fn ($query) => $query->first())
            ->when($this->search, function ($query, $search) {
                $query->where('nama_kost', 'LIKE', "%$search%")
                    ->orWhere('alamat', 'LIKE', "%$search%")
                    ->orWhere('deskripsi', 'LIKE', "%$search%")
                    ->orWhere('harga', 'LIKE', "%$search%")
                    ->orWhere('latitude', 'LIKE', "%$search%")
                    ->orWhere('longitude', 'LIKE', "%$search%");
            });

        return $this->applyPagination($query);
    }

    #[Computed()]
    public function allData()
    {
        return Kost::all();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function render()
    {
        return view('livewire.landing-page.cari-kost');
    }
}
