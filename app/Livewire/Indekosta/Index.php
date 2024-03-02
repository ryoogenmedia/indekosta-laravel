<?php

namespace App\Livewire\Indekosta;

use App\Livewire\Traits\DataTable\WithBulkActions;
use App\Livewire\Traits\DataTable\WithCachedRows;
use App\Livewire\Traits\DataTable\WithPerPagePagination;
use App\Livewire\Traits\DataTable\WithSorting;
use App\Models\Kost;
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
        $kost = Kost::whereIn('id', $this->selected)->get();
        $deleteCount = $kost->count();

        foreach ($kost as $data) {
            $data->delete();
        }

        $this->reset();

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "$deleteCount data kost berhasil dihapus.",
        ]);

        return redirect()->route('indekosta.index');
    }

    #[Computed()]
    public function rows()
    {
        $query = Kost::query()
            ->when(!$this->sorts, fn ($query) => $query->first())
            ->when($this->filters['search'], function ($query, $search) {
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
        return view('livewire.indekosta.index');
    }
}
