<?php

namespace App\Http\Livewire\PA\Gallery;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Posting\Gallery;
use App\Models\Posting\GalleryPhoto;
use Intervention\Image\Facades\Image;

class Create extends Component
{
    use WithFileUploads;
    public $judul, $images;

    public function render()
    {
        $bcs = [
            [
                'route' => 'admin.gallery-index',
                'title' => 'Daftar Gallery',
            ],
            [
                'route' => 'admin.gallery-index',
                'title' => 'Buat Album',
            ],
        ];
        return view('livewire.p-a.gallery.create')
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Buat Album',
                'bcs' => $bcs
            ]);
    }

    public function store()
    {
        $validate = $this->validate([
            'judul' => 'required|string',
            'images' => 'max:10',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:100000',
        ]);

        if ($validate) {
            $data = new Gallery();
            $data->title = $this->judul;
            $data->slug = Str::slug($this->judul);
            $data->status = 'publish';
            $data->user_id = auth()->user()->id;
            $data->save();

            if ($data && $this->images) {
                foreach ($this->images as $key => $image) {
                    $photo = $image;
                    $imageName = $key . time() . '.png';

                    // ORIGINAL
                    $destinationPath = public_path('/storage/gallery/');
                    $img = Image::make($photo->getRealPath());
                    $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath . $imageName, 100);

                    $image = new GalleryPhoto;
                    $image->gallery_id = $data->id;
                    $image->image = $imageName;
                    $image->save();

                    if ($key == 0) {
                        $data->image = $imageName;
                        $data->save();
                    }
                }
            }

            $this->showToastr('success', 'Berhasil', 'Album berhasil ditambahkan.');
            redirect()->route('admin.gallery-index');
        }
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
