<?php

namespace App\Livewire\LandingPage;


use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\Recomendation;
use App\Models\Kost;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class DetailKost extends Component
{
    #[Layout('layouts.landing-page')]
    #[Title('Detail Kost')]

    public $kost;
    public $recomendations;

    public $harga;
    public $alamat;
    public $deskripsi;
    public $namaKost;

    public $persent;
    public $category;

    public $categoryId;

    public $startLimit = 5;
    public $showMore = true;

    public $rating = 5;
    public $comment;
    public $totalRecomendation;

    public function backPrice(){
        $this->harga = $this->kost->harga;
        $this->persent = null;
        $this->categoryId = null;
    }

    public function moreComment(){
        $this->startLimit += 5;

        $this->recomendations = $this->kost
            ->recomendation()
            ->limit($this->startLimit)
            ->get();

        if($this->startLimit > $this->totalRecomendation){
            $this->showMore = false;
        }
    }

    public function discount($id){
        $category = Category::findOrFail($id);
        $this->persent = $category->persent;
        $this->harga = $this->kost->harga - ($this->persent / 100 * $this->kost->harga);
        $this->categoryId = $id;
    }

    public function addComment(){
        $user = auth()->user();

        try{
            DB::beginTransaction();

                $check = Recomendation::where('kost_id', $this->kost->id)
                    ->where('user_id', $user->id)
                    ->first() ?? null;

                if(!$check && $user){
                    Recomendation::create([
                        'kost_id' => $this->kost->id,
                        'user_id' => $user->id,
                        'rating' => $this->rating,
                        'nama' => $user->username,
                        'email' => $user->email,
                        'ulasan' => $this->comment,
                    ]);
                }else{
                    session()->flash('alert', [
                        'type' => 'danger',
                        'message' => 'Gagal.',
                        'detail' => "anda hanya dapat membuat sekali komentar!",
                    ]);

                    return redirect()->route('landing-page.detail-kost', $this->kost->id);
                }

            DB::commit();
        }catch(\Exception $e){
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "ulasan gagal ditambah.",
            ]);

            return redirect()->route('landing-page.detail-kost', $this->kost->id);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "ulasan berhasil ditambah.",
        ]);

        return redirect()->route('landing-page.detail-kost', $this->kost->id);
    }

    public function mount($id){
        $this->kost = Kost::findOrFail($id);

        if($this->kost){
            $this->harga = $this->kost->harga;
            $this->alamat = $this->kost->alamat;
            $this->deskripsi = $this->kost->deskripsi;
            $this->namaKost = $this->kost->nama_kost;
            
            $this->category = $this->kost->category;
            $this->recomendations = $this->kost
                ->recomendation()
                ->limit($this->startLimit)
                ->get();
            
            $this->totalRecomendation = $this->kost->recomendation()->count();

            $this->dispatch('data-kost', $this->kost);
            $this->dispatch('data-recomendations', $this->recomendations);
        }
    }

    public function render()
    {
        return view('livewire.landing-page.detail-kost');
    }
}
