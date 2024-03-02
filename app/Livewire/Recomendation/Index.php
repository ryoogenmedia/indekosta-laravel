<?php

namespace App\Livewire\Recomendation;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\Recomendation;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    use WithBulkActions;
    use WithPerPagePagination;
    use WithCachedRows;
    use WithSorting;

    public $filters = [
        'search' => '',
    ];

    public function deleteSelected()
    {
        $recomendation = Recomendation::whereIn('id', $this->selected)->get();
        $deleteCount = $recomendation->count();

        foreach ($recomendation as $data) {
            $data->delete();
        }

        $this->reset();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "$deleteCount data rekomendasi berhasil dihapus.",
        ]);

        return redirect()->route('recomendation.index');
    }

    #[Computed()]
    public function rows()
    {
        $query = Recomendation::query()
            ->when(!$this->sorts, fn ($query) => $query->first())
            ->when($this->filters['search'], function ($query, $search) {
                $query->where('rating', 'LIKE', "%$search%")
                    ->orWhere('nama', 'LIKE', "%$search%")
                    ->orWhere('ulasan', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
            });

        return $this->applyPagination($query);
    }

    #[Computed()]
    public function allData()
    {
        return Recomendation::all();
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
        return view('livewire.recomendation.index');
    }
}
