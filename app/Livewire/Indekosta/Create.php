<?php

namespace App\Livewire\Indekosta;

use App\Models\Category;
use App\Models\Kost;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $namaKost;
    public $gambar;
    public $alamat;
    public $deskripsi;
    public $harga;

    public $longitude = '';
    public $latitude = '';

    public $kategoriKerja;
    public $kategoriKuliah;
    public $kategoriPasutri;

    public $persentKerja;
    public $persentKuliah;
    public $persentPasutri;

    public function rules()
    {
        return [
            'namaKost' => ['required', 'string', 'min:2', 'max:255'],
            'gambar' => ['nullable', 'image', 'max:2045'],
            'alamat' => ['required', 'string'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required'],

            'longitude' => ['nullable'],
            'latitude' => ['nullable'],

            'kategoriKerja' => ['nullable'],
            'kategoriKuliah' => ['nullable'],
            'kategoriPasutri' => ['nullable'],

            'persentKerja' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'persentKuliah' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'persentPasutri' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $kost = Kost::create([
                'nama_kost' => $this->namaKost,
                'alamat' => $this->alamat,
                'deskripsi' => $this->deskripsi,
                'harga' => $this->harga,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ]);

            if ($this->gambar) {
                $kost->update([
                    'image' => $this->gambar->store('gambar-kost', 'public')
                ]);
            }

            if ($this->persentKerja && $this->kategoriKerja) {
                Category::create([
                    'kost_id' => $kost->id,
                    'category' => 'kerja',
                    'persent' => $this->persentKerja,
                ]);
            }

            if ($this->persentKuliah && $this->kategoriKuliah) {
                Category::create([
                    'kost_id' => $kost->id,
                    'category' => 'kuliah',
                    'persent' => $this->persentKuliah,
                ]);
            }

            if ($this->persentPasutri && $this->kategoriPasutri) {
                Category::create([
                    'kost_id' => $kost->id,
                    'category' => 'pasutri',
                    'persent' => $this->persentPasutri,
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "data kost gagal ditambah.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "data kost berhasil ditambah.",
        ]);

        return redirect()->route('indekosta.index');
    }

    public function render()
    {
        return view('livewire.indekosta.create');
    }
}
