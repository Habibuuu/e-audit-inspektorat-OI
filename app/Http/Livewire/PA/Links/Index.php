<?php

namespace App\Http\Livewire\PA\Links;

use Livewire\Component;
use App\Models\Util\Links;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Index extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $dataId, $newData, $image, $imagePrev;
    public $updateMode = false;

    protected $rules = [
        'newData.title' => 'required',
        'newData.url' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:15120',
    ];

    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = Links::paginate(10);

        $bcs = [
            [
                'route' => 'admin.settings-link',
                'title' => 'Link Terkait',
            ],
        ];
        return view('livewire.p-a.links.index', [
            'datas' => $datas,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Link Terkait',
                'bcs' => $bcs
            ]);
    }

    public function resetInputFields()
    {
        $this->dataId = null;
        $this->newData = null;
        $this->image = null;
        $this->imagePrev = null;
        $this->updateMode = false;
    }

    public function cancel()
    {
        $this->resetInputFields();
        $this->imagePrev = null;
    }

    public function store()
    {
        $validasi = $this->validate($this->rules, [], [
            'newData.title' => 'Judul',
            'newData.url' => 'URL',
            'newData.image' => 'Gambar',
        ]);

        if ($validasi) {
            $data = new Links();
            $data->title = $this->newData['title'];
            $data->url = $this->newData['url'];
            $data->status = 'Draft';
            $data->user_id = auth()->user()->id;
            if ($this->image) {
                $image = $this->image;
                $imageName = time() . '-' . Str::slug($this->newData['title']) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/storage/links/');
                $img = Image::make($image->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $imageName, 100);

                $data->image = $imageName;
            }
            $data->save();

            $this->resetInputFields();
            $this->showToastr('success', 'Berhasil', 'Link terkait berhasil ditambahkan');
            $this->emit('closeModal');
        }
    }

    public function update()
    {
        $validasi = $this->validate($this->rules);

        if ($validasi) {
            // $this->newData['id'] = $this->dataId;
            // $this->newData['status'] = 'Draft';
            // $this->newData['user_id'] = auth()->user()->id;
            if ($this->image) {
                $image = $this->image;
                $imageName = time() . '-' . Str::slug($this->newData['title']) . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/storage/links/');
                $img = Image::make($image->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $imageName, 100);

                $this->newData['image'] = $imageName;
            }
            $this->newData->save();

            $this->resetInputFields();
            $this->showToastr('success', 'Berhasil', 'Link terkait berhasil ditambahkan');
            $this->emit('closeModal');
        }
    }

    public function edit($id)
    {
        $this->resetErrorBag();
        $this->dataId = $id;
        $this->updateMode = true;
        $this->newData = Links::find($id);
        $this->imagePrev = $this->newData['image'];
    }

    public function delete($id)
    {
        $data = Links::findOrFail($id);
        $data->delete();

        $this->showToastr('success', 'Berhasil', 'Link Terkait berhasil dihapus!');
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Link Terkait!',
            'text'        => "Anda yakin untuk menghapus Link Terkait ini?",
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
        $data = Links::findOrFail($id);
        $oldStatus = $data->status;
        if ($oldStatus == 'Publish') {
            $data->status = 'Draft';
        } else {
            $data->status = 'Publish';
        }

        $data->save();
        $this->showToastr('success', 'Berhasil', 'Status Link Terkait berhasil diperbarui!');
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
