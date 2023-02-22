<?php

namespace App\Http\Livewire\PA\Page;

use Livewire\Component;
use App\Models\Posting\Page;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $filterJudul, $filterJenis;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = Page::latest()
            ->where('title', 'like', '%' . $this->filterJudul . '%')
            ->paginate(10);

        $bcs = [
            [
                'route' => 'admin.page-index',
                'title' => 'Halaman',
            ],
        ];
        return view('livewire.p-a.page.index', [
            'datas' => $datas,
        ])->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Halaman',
                'bcs' => $bcs
            ]);
    }
    public function filter()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->filterJudul = '';
        $this->filterJenis = '';
    }

    public function changeStatus($id)
    {
        $data = Page::findOrFail($id);
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
        $data = Page::findOrFail($id);
        $data->delete();

        $this->showToastr('success', 'Berhasil', 'Halaman berhasil dihapus!');
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Halaman!',
            'text'        => "Anda yakin untuk menghapus Halaman ini?",
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
