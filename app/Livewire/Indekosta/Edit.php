<?php

namespace App\Livewire\Indekosta;

use App\Models\Category;
use App\Models\Kost;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $namaKost;
    public $gambar;
    public $alamat;
    public $deskripsi;
    public $harga;

    public $longitude;
    public $latitude;

    public $kostId;

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

    public function edit()
    {
        $this->validate();

        $kost = Kost::findOrFail($this->kostId);
        $category = Category::where('kost_id', $this->kostId)->get();

        try {
            DB::beginTransaction();

            $kost->update([
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

            foreach ($category as $data) {
                if ($data->category == 'kerja' && $this->persentKerja && $this->kategoriKerja) {
                    $data->update([
                        'kost_id' => $kost->id,
                        'category' => 'kerja',
                        'persent' => $this->persentKerja,
                    ]);
                }

                if ($data->category == 'kuliah' && $this->persentKuliah && $this->kategoriKuliah) {
                    $data->update([
                        'kost_id' => $kost->id,
                        'category' => 'kuliah',
                        'persent' => $this->persentKuliah,
                    ]);
                }

                if ($data->category == 'pasutri' && $this->persentPasutri && $this->kategoriPasutri) {
                    $data->update([
                        'kost_id' => $kost->id,
                        'category' => 'pasutri',
                        'persent' => $this->persentPasutri,
                    ]);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "data kost gagal disunting.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "data kost berhasil disunting.",
        ]);

        return redirect()->route('indekosta.index');
    }

    public function mount($id)
    {
        $kost = Kost::findOrFail($id);
        $category = Category::where('kost_id', $kost->id)->get();

        if ($kost) {
            $this->kostId = $kost->id;
            $this->namaKost = $kost->nama_kost;
            $this->alamat = $kost->alamat;
            $this->deskripsi = $kost->deskripsi;
            $this->harga = $kost->harga;

            if($kost->latitude && $kost->longitude){
                $this->latitude = $kost->latitude;
                $this->longitude = $kost->longitude;
            }else{
                $this->longitude = 119.40353393554689;
                $this->latitude = -5.155978984099238;
            }
        }

        if ($category) {
            foreach ($category as $data) {
                if ($data->category == 'kuliah') {
                    $this->kategoriKuliah = true;
                    $this->persentKuliah = $data->persent;
                }

                if ($data->category == 'kerja') {
                    $this->kategoriKerja = true;
                    $this->persentKerja = $data->persent;
                }

                if ($data->category == 'pasutri') {
                    $this->kategoriPasutri = true;
                    $this->persentPasutri = $data->persent;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.indekosta.edit');
    }
}
