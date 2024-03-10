<?php

namespace App\Livewire\LandingPage;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Kost;

class Recomendation extends Component
{
    use WithBulkActions;
    use WithPerPagePagination;
    use WithCachedRows;
    use WithSorting;

    #[Layout('layouts.landing-page')]
    #[Title('Rekomendasi')]

    public $search = '';
    public $category = '';

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
            })
            ->when($this->category, function($query, $category){
                $query->whereHas('category', function($query) use ($category){
                    $query->where('category', 'LIKE', "%$category%");
                });
            });

        return $this->applyPagination($query);
    }

    public function categoryKerja(){
        $this->category = 'kerja';
    }

    public function categoryKuliah(){
        $this->category = 'kuliah';
    }

    public function categroyPasutri(){
        $this->category = 'pasutri';
    }

    public function backCategory(){
        $this->reset('category');
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
        return view('livewire.landing-page.recomendation');
    }
}
