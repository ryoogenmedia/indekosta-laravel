<?php

namespace App\Livewire\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $username;
    public $email;
    public $password;
    public $avatar;

    public $userId;

    public function rules()
    {
        return [
            'username' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'min:2', 'unique:users,email,' . $this->userId],
            'password' => ['nullable', 'string', Password::default()],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function edit()
    {
        $this->validate();

        $user = User::whereId($this->userId)->first();

        try {
            DB::beginTransaction();

            $user->update([
                'username' => $this->username,
                'email' => $this->email,
                'roles' => 'admin',
            ]);

            if ($this->password) {
                $user->update(['password' => bcrypt($this->password)]);
            }

            if ($this->avatar) {
                Storage::disk('avatar')->delete($user->avatar);

                $user->update(['avatar' => $this->avatar->store('avatars', 'public')]);
            }

            DB::commit();
        } catch (Exception $e) {
            session()->flash('alert', [
                'type' => 'danger',
                'message' => 'Gagal.',
                'detail' => "data pengguna gagal disunting.",
            ]);
        }

        session()->flash('alert', [
            'type' => 'success',
            'message' => 'Berhasil.',
            'detail' => "data pengguna berhasil disunting.",
        ]);

        return redirect()->route('user.index');
    }

    public function mount($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            $this->userId = $user->id;
            $this->username = $user->username;
            $this->email = $user->email;
        }
    }

    public function render()
    {
        return view('livewire.user.edit');
    }
}
