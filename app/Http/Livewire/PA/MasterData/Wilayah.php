<?php

namespace App\Http\Livewire\PA\MasterData;

use App\Models\MasterData\Wilayah as MasterDataWilayah;
use Livewire\Component;
use Livewire\WithPagination;

class Wilayah extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $wilayahId, $nama_wilayah, $filterWilayah;
    public $updateMode = false;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = MasterDataWilayah::latest()
            ->where('name', 'like', '%' . $this->filterWilayah . '%')
            ->paginate(10);

        $bcs = [
            [
                'route' => 'admin.articles-category-index',
                'title' => 'Daftar Master Wilayah',
            ],
        ];
        return view('livewire.p-a.master-data.wilayah', [
            'datas' => $datas,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Master Wilayah',
                'bcs' => $bcs
            ]);
    }

    public function filter()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->filterWilayah = '';
    }

    private function resetInputFields()
    {
        $this->nama_wilayah = '';
    }

    public function store()
    {
        $validasi = $this->validate([
            'nama_wilayah' => 'required',
        ]);

        if ($validasi) {
            $data = new MasterDataWilayah;
            $data->name = $this->nama_wilayah;
            $data->save();

            $this->showToastr('success', 'Wilayah berhasil ditambahkan.');
            $this->resetInputFields();
            $this->emit('closeModal'); // Close model to using to jquery
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $data = MasterDataWilayah::findOrFail($id);

        $this->wilayahId = $id;
        $this->nama_wilayah = $data->name;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validasi = $this->validate([
            'nama_wilayah' => 'required',
        ]);

        if ($this->wilayahId) {
            $data = MasterDataWilayah::findorFail($this->wilayahId);
            $data->name = $this->nama_wilayah;
            $data->save();

            $this->updateMode = false;
            $this->showToastr('success', 'Wilayah berhasil diperbarui.');
            $this->resetInputFields();
            $this->emit('closeModal'); // Close model to using to jquery
        }
    }

    public function changeStatus($id)
    {
        $data = MasterDataWilayah::findOrFail($id);
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
            MasterDataWilayah::find($id)->delete();
            $this->showToastr('success', 'Wilayah berhasil dihapus.');
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
