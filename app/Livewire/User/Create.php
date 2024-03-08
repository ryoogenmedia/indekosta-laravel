<?php

namespace App\Livewire\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $username;
    public $email;
    public $password;
    public $avatar;

    public function rules()
    {
        return [
            'username' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'min:2', 'unique:users,email'],
            'password' => ['required', 'string', Password::default()],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $user = User::create([
                'username' => $this->username,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'roles' => 'admin',
            ]);

            if ($this->avatar) {
                $user->update([
                    'avatar' => $this->avatar->store('avatars', 'public'),
                ]);
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "data pengguna gagal ditambah.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "data pengguna berhasil ditambah.",
        ]);

        return redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
