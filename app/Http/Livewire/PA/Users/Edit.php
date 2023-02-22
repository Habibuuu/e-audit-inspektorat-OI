<?php

namespace App\Http\Livewire\PA\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Users\UserRole;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class Edit extends Component
{
    use WithFileUploads;
    public $userId;
    public $nama_lengkap;
    public $email;
    public $username;
    public $password;
    public $password_confirmation;
    public $photo_profile;
    public $photo;
    public $roleId;
    public $roleName;

    public function mount($id)
    {
        $data = User::findOrFail($id);
        if ($data) {
            $this->userId = $data->id;
            $this->nama_lengkap = $data->fullname;
            $this->email = $data->email;
            $this->username = $data->username;
            $this->photo = $data->photo;
            $this->roleId = $data->Role->id;
            $this->roleName = $data->Role->name;
        }
    }

    public function update()
    {
        $user = User::findOrFail($this->userId);
        $validasi = $this->validate([
            'nama_lengkap' => 'required|min:5',
            'email' => 'required|unique:users|email',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'username' => 'required|unique:users',
            'username' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|confirmed|min:5',
            'roleId' => 'required',
            'photo_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $parts = explode('@', $this->email);
        $username = $parts[0];

        $fullname = explode(' ', $this->nama_lengkap, 2);
        $firstName = $fullname[0];
        $lastName = '';
        if (isset($fullname[1])) {
            $lastName = $fullname[1];
        }

        if ($validasi) {
            $user->fullname = $this->nama_lengkap;
            $user->firstname = $firstName;
            $user->lastname = $lastName;
            $user->email = $this->email;
            $user->username = $this->username;
            $user->google_id = null;
            $user->account_status = 'active';
            $user->role_id = $this->roleId;

            if ($this->password) {
                $user->password = Hash::make($this->password);
            }
            if ($this->photo_profile) {
                if ($this->photo_profile) {
                    $photo = $this->photo_profile;
                    $imageName = time() . '-' . Str::slug($this->nama_lengkap) . '.' . $photo->getClientOriginalExtension();

                    $destinationPath = public_path('/storage/images/users/');
                    $img = Image::make($photo->getRealPath());
                    $QuploadImage = $img->resize(480, 480, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . $imageName, 100);
                    $user->photo = $imageName;
                }
            }
            $user->save();

            $this->showToastr('success', 'Pengguna berhasil diperbarui!');
        }
    }

    public function render()
    {
        $roles = UserRole::where('id', '!=', '1')->get();
        return view('livewire.p-a.users.edit', [
            'roles' => $roles,
        ])
            ->layout('admin.layouts.app');
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
    public function showToastr($icon, $title)
    {
        $this->emit('swal:alert', [
            'icon'    => $icon,
            'title'   => $title,
            'timeout' => 10000
        ]);
    }
}
