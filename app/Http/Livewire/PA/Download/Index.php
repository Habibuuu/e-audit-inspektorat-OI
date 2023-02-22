<?php

namespace App\Http\Livewire\PA\Download;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Posting\Download;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $updateMode = false;
    public $dataId, $title, $description, $file;
    protected $rules = [
        'title' => 'required',
        'description' => 'nullable',
        'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx,xls,xlsx,rar,zip|max:15120',
    ];

    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = Download::latest()->paginate(10);
        $bcs = [
            [
                'route' => '',
                'title' => 'Download',
            ],
        ];
        return view('livewire.p-a.download.index', [
            'datas' => $datas,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Download',
                'bcs' => $bcs
            ]);
    }

    public function resetInputFields()
    {
        $this->title = null;
        $this->description = null;
        $this->file = null;
        $this->updateMode = false;
    }

    public function cancel()
    {
        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function store()
    {
        $validasi = $this->validate($this->rules);

        if ($validasi) {
            $data = new Download();
            $data->title = $this->title;
            $data->description = $this->description;
            if ($this->file) {
                $googleUpload = Storage::disk('google')->put('Download', $this->file, 'public');
                $gdfiles = Storage::disk('google')->listContents('Download');
                $gdfiles = collect($gdfiles);
                $return = $gdfiles->where('path', $googleUpload)->first();
                $data->google_id = $return['id'];
            }
            $data->status = 'Draft';
            $data->save();

            $this->showToastr('success', 'File berhasil diupload!');
            $this->resetInputFields();
            $this->emit('closeModal');
        }
    }

    public function edit($id)
    {
        $this->resetErrorBag();
        $this->updateMode = true;
        $data = Download::findOrFail($id);
        $this->dataId = $data->id;
        $this->title = $data->title;
        $this->description = $data->description;
    }

    public function update()
    {
        $validasi = $this->validate(
            [
                'title' => 'required',
                'description' => 'nullable',
                'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx,xls,xlsx,rar,zip|max:15120',
            ]
        );

        if ($validasi && $this->updateMode == true) {
            $data = Download::findOrFail($this->dataId);
            $data->title = $this->title;
            $data->description = $this->description;
            if ($this->file) {
                $googleUpload = Storage::disk('google')->put('Download', $this->file, 'public');
                $gdfiles = Storage::disk('google')->listContents('Download');
                $gdfiles = collect($gdfiles);
                $return = $gdfiles->where('path', $googleUpload)->first();
                $data->google_id = $return['id'];
            }
            $data->save();
            $this->showToastr('success', 'Data Download berhasil diperbarui!');
            $this->emit('closeModal');
        }
    }

    public function delete($id)
    {
        $data = Download::findOrFail($id);
        $data->delete();

        $this->showToastr('success', 'File berhasil dihapus!');
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus File!',
            'text'        => "Anda yakin untuk menghapus File ini?",
            'confirmText' => 'Hapus!',
            'cancelText' => 'Tidak!',
            'method'      => 'appointments:delete',
            'onConfirmed' => 'confirmed',
            'params'      => $dataId, // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function changeStatus($id)
    {
        $data = Download::findOrFail($id);
        $oldStatus = $data->status;
        if ($oldStatus == 'Publish') {
            $data->status = 'Draft';
        } else {
            $data->status = 'Publish';
        }

        $data->save();
        $this->showToastr('success', 'Status berhasil diperbarui!');
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
