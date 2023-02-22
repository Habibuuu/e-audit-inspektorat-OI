<?php

namespace App\Http\Livewire\PA\Gallery;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Posting\Gallery;
use Intervention\Image\Facades\Image;
use App\Models\Posting\GalleryCategory;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $searchTitle;
    public $dataId, $judul, $kategori, $photo, $photoPrev, $konten;
    public $editMode = false;
    public $nama_kategori;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $searchTitle = $this->searchTitle;
        $datas = Gallery::latest()
            ->where('title', 'LIKE', '%' . $searchTitle . '%')
            ->paginate(10);
        $arrKategori = GalleryCategory::orderBy('name')->get();

        $bcs = [
            [
                'route' => 'admin.gallery-index',
                'title' => 'Daftar Gallery',
            ],
        ];
        return view('livewire.p-a.gallery.index', [
            'datas' => $datas,
            'arrKategori' => $arrKategori,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Gallery',
                'bcs' => $bcs
            ]);
    }

    public function resetField()
    {
        $this->dataId = null;
        $this->nama_kategori = null;
        $this->judul = null;
        $this->kategori = null;
        $this->konten = null;
        $this->photo = null;
        $this->photoPrev = null;
        $this->editMode = false;
    }

    public function storeKategori()
    {
        $validate = $this->validate([
            'nama_kategori' => 'required',
        ]);

        if ($validate) {
            $kategori = new GalleryCategory();
            $kategori->name = $this->nama_kategori;
            $kategori->slug = Str::slug($this->nama_kategori);
            $kategori->save();

            $this->emit('closeModal');
            $this->showToastr('success', 'Kategori berhasil ditambahkan');
        }
    }

    public function storePhoto()
    {
        $validate = $this->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'konten' => 'nullable',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        if ($validate) {
            $data = new Gallery();
            $data->title = $this->judul;
            $data->slug = Str::slug($this->judul);
            $data->category_id = $this->kategori;
            $data->content = $this->konten;
            $data->status = 'Publish';
            $data->user_id = auth()->user()->id;

            if ($this->photo) {
                $photo = $this->photo;
                $imageName = time() . '-' . Str::slug($this->judul) . '.' . $photo->getClientOriginalExtension();

                // ORIGINAL
                $destinationPath = public_path('/storage/gallery/');
                $img = Image::make($photo->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $imageName, 100);
                $data->image = $imageName;
            }

            $data->save();

            $this->emit('closeModal');
            $this->showToastr('success', 'Foto berhasil ditambahkan');
        }
    }

    public function getData($id)
    {
        $data = Gallery::find($id);
        $this->dataId = $id;
        $this->judul = $data->title;
        $this->kategori = $data->category_id;
        $this->konten = $data->content;
        $this->photoPrev = $data->image;

        $this->editMode = true;
    }

    public function updatePhoto()
    {
        $validate = $this->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'konten' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        if ($validate && $this->dataId && $this->editMode == true) {
            $data = Gallery::find($this->dataId);
            $data->title = $this->judul;
            $data->slug = Str::slug($this->judul);
            $data->category_id = $this->kategori;
            $data->content = $this->konten;

            if ($this->photo) {
                $photo = $this->photo;
                $imageName = time() . '-' . Str::slug($this->judul) . '.' . $photo->getClientOriginalExtension();

                // ORIGINAL
                $destinationPath = public_path('/storage/gallery/');
                $img = Image::make($photo->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $imageName, 100);
                $data->image = $imageName;
            }

            $data->save();

            $this->emit('closeModal');
            $this->showToastr('success', 'Foto berhasil diperbarui');
        }
    }

    public function delete($idData)
    {
        $data = Gallery::find($idData);
        if ($data) {
            $data->delete();
            $this->showToastr('success', 'Album berhasil dihapus.');
        } else {
            $this->showToastr('error', 'Something Error.');
        }
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Album!',
            'text'        => "Anda yakin untuk menghapus Album ini?",
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
