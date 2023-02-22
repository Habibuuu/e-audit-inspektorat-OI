<?php

namespace App\Http\Livewire\PA\Gallery;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Posting\Gallery;
use App\Models\Posting\GalleryPhoto;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class Edit extends Component
{
    use WithFileUploads;
    public $data;
    public $judul, $images;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function mount($id)
    {
        $data = Gallery::find($id);
        $this->dataId = $data->id;
        $this->judul = $data->title;
        $this->prevImages = $data->Photos;
    }

    public function render()
    {
        $bcs = [
            [
                'route' => 'admin.gallery-index',
                'title' => 'Daftar Gallery',
            ],
            [
                'route' => 'admin.gallery-index',
                'title' => 'Edit Album',
            ],
        ];
        return view('livewire.p-a.gallery.edit')
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Edit Album',
                'bcs' => $bcs
            ]);
    }

    public function store()
    {
        $validate = $this->validate([
            'judul' => 'required|string',
        ]);
        if ($validate) {
            $data = Gallery::find($this->dataId);
            $data->title = $this->judul;
            $data->slug = Str::slug($this->judul);
            $data->save();
            $this->showToastr('success', 'Berhasil', 'Album telah diperbarui.');
        }
    }

    public function updated($field)
    {
        if ($field == 'images') {
            $this->validate([
                'images' => 'max:10',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:100000',
            ]);

            foreach ($this->images as $key => $image) {
                $photo = $image;
                $imageName = $key . time() . '.png';

                // ORIGINAL
                $destinationPath = public_path('/storage/gallery/');
                $img = Image::make($photo->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $imageName, 100);

                $image = new GalleryPhoto();
                $image->gallery_id = $this->dataId;
                $image->image = $imageName;
                $image->save();
            }

            $this->showToastr('success', 'Berhasil', 'Photo telah ditambahkan.');
            $this->mount($this->dataId);
        }
    }

    public function delete($idData)
    {
        $data = GalleryPhoto::find($idData);

        if ($data) {
            File::delete(public_path("storage/gallery/{$data->image}"));
            $data->delete();
            $this->showToastr('success', 'Berhasil', 'Photo has been Deleted.');
            $this->mount($this->dataId);
        } else {
            $this->showToastr('error', '', 'Something Error.');
        }
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Delete Image!',
            'text'        => "Are Your sure to Delete this Image?",
            'confirmText' => 'Delete!',
            'cancelText' => 'No!',
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
            'text'  => $text,
            'timeout' => 10000
        ]);
    }
}
