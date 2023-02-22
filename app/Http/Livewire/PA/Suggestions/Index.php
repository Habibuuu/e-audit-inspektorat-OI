<?php

namespace App\Http\Livewire\PA\Suggestions;

use App\Models\Settings\Suggestion;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $selectedData;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = Suggestion::latest()->paginate(10);
        return view('livewire.p-a.suggestions.index', [
            'datas' => $datas,
        ])
            ->layout('admin.layouts.app');
    }

    public function getData($id)
    {
        $this->selectedData = Suggestion::find($id);
    }

    public function verify($idData)
    {
        if ($data = Suggestion::find($idData)) {
            $data->status = 'allowed';
            $data->save();

            $this->showToastr('success', 'Kritik & Saran berhasil disetujui');
        };
    }

    public function pending($idData)
    {
        if ($data = Suggestion::find($idData)) {
            $data->status = 'pending';
            $data->save();

            $this->showToastr('success', 'Kritik & Saran berhasil dipending');
        };
    }


    public function delete($idData)
    {
        $data = Suggestion::find($idData);
        if ($data) {
            $data->delete();
            $this->showToastr('success', 'Kritik & Saran berhasil dihapus.');
        } else {
            $this->showToastr('error', 'Something Error.');
        }
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Kritik & Saran!',
            'text'        => "Anda yakin untuk menghapus Kritik & Saran ini?",
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
