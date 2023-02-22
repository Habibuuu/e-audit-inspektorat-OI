<?php

namespace App\Http\Livewire\PA\Users;

use App\Models\User;
use App\Models\Users\UserRole;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $updateMode = false;
    public $pengguna;

    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = User::where('id', '>', '1')->latest()->paginate(10);
        $roles = UserRole::where('id', '!=', 1)->get();

        $bcs = [
            [
                'route' => 'admin.users-index',
                'title' => 'Manajemen Pengguna',
            ],
        ];
        return view('livewire.p-a.users.index', [
            'datas' => $datas,
            'roles' => $roles
        ])->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Pengguna',
                'bcs' => $bcs
            ]);
    }

    public function resetInput()
    {
        $this->pengguna = null;
        $this->updateMode = false;
    }

    public function store()
    {
        $validate = $this->validate([
            'pengguna.fullname' => 'required|string|max:255',
            'pengguna.username' => 'required|string|alpha_dash|max:255|unique:users,username',
            'pengguna.email' => 'required|string|email|max:255|unique:users,email',
            'pengguna.password' => 'required|string|min:6|confirmed',
            'pengguna.role_id' => 'required',
        ], [], [
            'pengguna.fullname' => 'Nama Lengkap',
            'pengguna.username' => 'Username',
            'pengguna.email' => 'Email',
            'pengguna.password' => 'Password',
            'pengguna.role_id' => 'Role',
        ]);

        if ($validate && $this->updateMode == false) {
            $data = new User();
            $data->fullname = $this->pengguna['fullname'];
            $data->username = $this->pengguna['username'];
            $data->email = $this->pengguna['email'];
            $data->password = bcrypt($this->pengguna['password']);
            $data->role_id = $this->pengguna['role_id'];
            $data->save();
            $this->resetInput();
            $this->emit('closeModal');

            $this->showToastr('success', 'Berhasil', 'Data berhasil ditambahkan');
        }
    }

    public function getPengguna($id)
    {
        $this->resetErrorBag();
        $data = User::find($id)->toArray();
        $this->pengguna = $data;
        $this->pengguna['password'] = null;
        $this->updateMode = true;
    }

    public function update()
    {
        $validate = $this->validate([
            'pengguna.fullname' => 'required|string|max:255',
            'pengguna.username' => 'required|string|alpha_dash|max:255|unique:users,username,' . $this->pengguna['id'],
            'pengguna.email' => 'required|string|email|max:255|unique:users,email,' . $this->pengguna['id'],
            'pengguna.password' => 'nullable|string|min:6|confirmed',
            'pengguna.role_id' => 'required',
        ], [], [
            'pengguna.fullname' => 'Nama Lengkap',
            'pengguna.username' => 'Username',
            'pengguna.email' => 'Email',
            'pengguna.password' => 'Password',
            'pengguna.role_id' => 'Role',
        ]);

        if ($validate && $this->updateMode == true) {
            $data = User::find($this->pengguna['id']);
            $data->fullname = $this->pengguna['fullname'];
            $data->username = $this->pengguna['username'];
            $data->email = $this->pengguna['email'];
            if ($this->pengguna['password']) {
                $data->password = bcrypt($this->pengguna['password']);
            }
            $data->role_id = $this->pengguna['role_id'];
            $data->save();;

            $this->showToastr('success', 'Berhasil', 'Data berhasil diperbarui');
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $this->showToastr('success', 'Berhasil', 'Pengguna berhasil dihapus!');
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Pengguna!',
            'text'        => "Anda yakin untuk menghapus Pengguna ini?",
            'confirmText' => 'Hapus!',
            'cancelText' => 'Tidak!',
            'method'      => 'appointments:delete',
            'onConfirmed' => 'confirmed',
            'params'      => $dataId, // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
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
