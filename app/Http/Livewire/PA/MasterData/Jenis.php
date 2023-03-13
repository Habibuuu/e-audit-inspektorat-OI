<?php

namespace App\Http\Livewire\PA\MasterData;

use App\Models\MasterData\Jenis as MasterDataJenis;
use Livewire\Component;
use Livewire\WithPagination;

class Jenis extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $jenisId, $nama_jenis, $filterJenis;
    public $updateMode = false;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = MasterDataJenis::latest()
            ->where('name', 'like', '%' . $this->filterJenis . '%')
            ->paginate(10);

        $bcs = [
            [
                'route' => 'admin.articles-category-index',
                'title' => 'Daftar Master Jenis',
            ],
        ];
        return view('livewire.p-a.master-data.jenis', [
            'datas' => $datas,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Master Jenis',
                'bcs' => $bcs
            ]);
    }

    public function filter()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->filterJenis = '';
    }

    public function store()
    {
        $validasi = $this->validate([
            'nama_jenis' => 'required',
        ]);

        if ($validasi) {
            $data = new MasterDataJenis;
            $data->name = $this->nama_jenis;
            $data->save();

            $this->showToastr('success', 'Jenis berhasil ditambahkan.');
            $this->resetInputFields();
            $this->emit('closeModal'); // Close model to using to jquery
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $data = MasterDataJenis::findOrFail($id);

        $this->jenisId = $id;
        $this->nama_jenis = $data->name;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validasi = $this->validate([
            'nama_jenis' => 'required',
        ]);

        if ($this->jenisId) {
            $data = MasterDataJenis::findorFail($this->jenisId);
            $data->name = $this->nama_jenis;
            $data->save();

            $this->updateMode = false;
            $this->showToastr('success', 'Jenis berhasil diperbarui.');
            $this->resetInputFields();
            $this->emit('closeModal'); // Close model to using to jquery
        }
    }

    public function changeStatus($id)
    {
        $data = MasterDataJenis::findOrFail($id);
        $oldStatus = $data->status;
        if ($oldStatus == 'Post') {
            $data->status = 'Draft';
        } elseif ($oldStatus == 'Draft') {
            $data->status = 'Post';
        }
        $data->save();
        $this->showToastr('success', 'Berhasil', 'Status Berhasil diubah!');
    }

    public function delete($id)
    {
        if ($id) {
            MasterDataJenis::find($id)->delete();
            $this->showToastr('success', 'Jenis berhasil dihapus.');
        }
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Kategori!',
            'text'        => "Anda yakin untuk menghapus Kategori ini?",
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
    public function showToastr($icon, $title)
    {
        $this->emit('swal:alert', [
            'icon'    => $icon,
            'title'   => $title,
            'timeout' => 10000
        ]);
    }
}
