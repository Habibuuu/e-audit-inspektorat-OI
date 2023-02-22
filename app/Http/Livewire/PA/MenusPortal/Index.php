<?php

namespace App\Http\Livewire\PA\MenusPortal;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Util\MenuPortals;
use Intervention\Image\Facades\Image;

class Index extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $dataId, $judul, $gambarGet, $gambar, $urutan, $url, $caption;
    public $updateMode = false;

    protected $listeners = [
        'appointments:delete' => 'delete',
    ];


    public function render()
    {
        $datas = MenuPortals::orderBy('sort')->paginate();

        $bcs = [
            [
                'route' => 'admin.settings-portal',
                'title' => 'Portal',
            ],
        ];
        return view('livewire.p-a.menus-portal.index', [
            'datas' => $datas,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Portal',
                'bcs' => $bcs
            ]);
    }

    public function resetInputFields()
    {
        $this->dataId = '';
        $this->judul = '';
        $this->caption = '';
        $this->url = '';
        $this->urutan = '';
        $this->gambar = '';
    }

    public function store()
    {
        $validasi = $this->validate([
            'judul' => 'required',
            'url' => 'required',
            'urutan' => 'required|numeric',
            'caption' => 'nullable',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:15120',
        ]);

        if ($validasi) {
            $data = new MenuPortals;
            $data->name = $this->judul;
            $data->caption = $this->caption;
            $data->url = $this->url;
            $data->sort = $this->urutan;
            $data->status = 'Draft';
            if ($this->gambar) {
                $image = $this->gambar;
                // $imageName = $data->slug . '.' . $image->getClientOriginalExtension();
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // ORIGINAL
                $destinationPath = public_path('/storage/portals/');
                $img = Image::make($image->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $imageName, 100);

                $data->image = $imageName;
            }
            $data->save();
        }

        $this->showToastr('success', 'Menu Portal berhasil ditambahkan!');
        $this->resetInputFields();
        $this->emit('closeModal');
    }


    public function edit($id)
    {
        $this->resetErrorBag();
        $this->updateMode = true;
        $data = MenuPortals::findOrFail($id);

        $this->dataId = $data->id;
        $this->judul = $data->name;
        $this->url = $data->url;
        $this->urutan = $data->sort;
        $this->caption = $data->caption;
        $this->gambarGet = $data->image;
        $this->status = $data->status;
    }

    public function update()
    {
        $validasi = $this->validate([
            'judul' => 'required',
            'url' => 'required',
            'urutan' => 'required|numeric',
            'caption' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:15120',
        ]);

        if ($validasi && $this->updateMode == true) {
            $data = MenuPortals::find($this->dataId);
            $data->name = $this->judul;
            $data->caption = $this->caption;
            $data->url = $this->url;
            $data->sort = $this->urutan;
            if ($this->gambar) {
                $image = $this->gambar;
                // $imageName = $data->slug . '.' . $image->getClientOriginalExtension();
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // ORIGINAL
                $destinationPath = public_path('/storage/portals/');
                $img = Image::make($image->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $imageName, 100);

                $data->image = $imageName;
            }
            $data->save();
        }

        $this->showToastr('success', 'Menu Portal berhasil diperbarui!');
        $this->resetInputFields();
        $this->emit('closeModal');
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $data = MenuPortals::findOrFail($id);
        $data->delete();

        $this->showToastr('success', 'Menu Portal berhasil dihapus!');
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Menu Portal!',
            'text'        => "Anda yakin untuk menghapus Menu Portal ini?",
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
        $data = MenuPortals::findOrFail($id);
        $oldStatus = $data->status;
        if ($oldStatus == 'Publish') {
            $data->status = 'Draft';
        } else {
            $data->status = 'Publish';
        }

        $data->save();
        $this->showToastr('success', 'Status Menu Portal berhasil diperbarui!');
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
