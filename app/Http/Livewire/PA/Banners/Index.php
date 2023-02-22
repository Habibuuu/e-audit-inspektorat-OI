<?php

namespace App\Http\Livewire\PA\Banners;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Util\Banners;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $dataId, $judul, $caption, $file, $fileGet, $status;
    public $updateMode = false;

    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = Banners::latest()->paginate(10);

        $bcs = [
            [
                'route' => '',
                'title' => 'Banner',
            ],
        ];

        return view('livewire.p-a.banners.index', [
            'datas' => $datas,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Banner',
                'bcs' => $bcs
            ]);
    }

    public function resetInputFields()
    {
        $this->dataId = null;
        $this->judul = null;
        $this->caption = null;
        $this->file = null;
    }

    public function store()
    {
        $validasi = $this->validate([
            'judul' => 'required',
            'caption' => 'nullable',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:15120',
        ]);

        if ($validasi) {
            $data = new Banners;
            $data->title = $this->judul;
            $data->slug = Str::slug($this->judul);
            $data->caption = $this->caption;
            $data->status = 'Draft';
            if ($this->file) {
                $file = $this->file;
                $fileName = $data->slug . '.' . $file->getClientOriginalExtension();

                // ORIGINAL
                $destinationPath = public_path('/storage/banners/');
                $img = Image::make($file->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $fileName, 100);

                $data->filename = $fileName;
            }
            $data->save();
        }

        $this->showToastr('success', 'Banner berhasil ditambahkan!');
        $this->resetInputFields();
        $this->emit('closeModal');
    }

    public function edit($id)
    {
        $this->resetErrorBag();
        $this->updateMode = true;
        $data = Banners::findOrFail($id);

        $this->dataId = $data->id;
        $this->judul = $data->title;
        $this->slug = $data->slug;
        $this->caption = $data->caption;
        $this->fileGet = $data->filename;
        $this->status = $data->status;
    }

    public function update()
    {
        $validasi = $this->validate([
            'judul' => 'required',
            'file' => 'nullable|image|mimes:jpeg,png,jpg|max:15120',
        ]);

        if ($validasi && $this->updateMode == true) {
            $data = Banners::findOrFail($this->dataId);
            $data->title = $this->judul;
            $data->slug = Str::slug($this->judul);
            $data->caption = $this->caption;

            if ($this->file) {
                $file = $this->file;
                $fileName = $data->slug . '.' . $file->getClientOriginalExtension();
                // $file->storeAs('/storage/banners/', $fileName, 'public');

                // ORIGINAL
                $destinationPath = public_path('/storage/banners/');
                $img = Image::make($file->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $fileName, 100);

                $data->filename = $fileName;
            }

            $data->save();

            $this->updateMode = false;
            $this->showToastr('success', 'Banner berhasil diperbarui!');
            $this->resetInputFields();
            $this->emit('closeModal');
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $data = Banners::findOrFail($id);
        $data->delete();

        $this->showToastr('success', 'Banner berhasil dihapus!');
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Banner!',
            'text'        => "Anda yakin untuk menghapus Banner ini?",
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
        $data = Banners::findOrFail($id);
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
