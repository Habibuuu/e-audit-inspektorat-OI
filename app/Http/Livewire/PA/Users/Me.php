<?php

namespace App\Http\Livewire\PA\Users;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Users\UserRole;
use Intervention\Image\Facades\Image;

class Me extends Component
{
    use WithFileUploads;
    public $user, $password, $password_confirmation, $photo;
    protected $rules = [
        'user.fullname' => 'required|string',
        'user.username' => 'required|alpha_dash',
        'user.email' => 'required|email',
        'password' => 'nullable|confirmed|alpha_dash'
    ];

    public function mount()
    {
        $this->user = auth()->user();
        // dd($this->user);
    }

    public function render()
    {
        $roles = UserRole::where('id', '!=', '1')->get();
        $bcs = [
            [],
        ];

        return view('livewire.p-a.users.me', [
            'roles' => $roles
        ])->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Pengguna',
                'bcs' => $bcs
            ]);
    }

    public function update()
    {
        $validate = $this->validate([
            'user.fullname' => 'required|string',
            'user.username' => 'required|alpha_dash|unique:users,username,' . $this->user->id,
            'user.email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|confirmed|alpha_dash'
        ], [], [
            'user.fullname' => 'Nama Lengkap',
            'user.username' => 'Username',
            'user.email' => 'Email',
            'user.role_id' => 'Jenis Pengguna',
            'password' => 'Kata sandi'
        ]);
        if ($validate) {
            if($this->password) {
                $this->user->password = bcrypt($this->password);
            }
            $this->user->save();
            $this->showToastr('success', 'Berhasil', 'Profil berhasil diperbarui');
        }
    }

    public function updated($field)
    {
        if ($field == 'photo') {
            if ($this->photo) {
                $photo = $this->photo;
                $imageName = time() . '-' . Str::slug($this->user->fullname) . '.' . $photo->getClientOriginalExtension();

                $destinationPath = public_path('/storage/images/users/');
                $img = Image::make($photo->getRealPath());
                $QuploadImage = $img->resize(480, 480, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $imageName, 100);

                $this->user->photo = $imageName;
                $this->user->save();
                $this->showToastr('success', 'Berhasil', 'Photo Profile berhasil diperbarui');
            }
        }
    }

    // SWEETALERT
    public function showAlert($icon, $title, $text)
    {
        $this->emit('swal:modal', [
            'icon'  => $icon,
            'title' => $title,
            'text'  => $text,
        ]);
    }

    // TOASTR
    public function showToastr($icon, $title, $text)
    {
        $this->emit('swal:alert', [
            'icon'    => $icon,
            'title'   => $title,
            'text'   => $text,
            'timeout' => 10000
        ]);
    }
}
