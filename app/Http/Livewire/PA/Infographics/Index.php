<?php

namespace App\Http\Livewire\PA\Infographics;

use App\Models\Articles\ArticleType;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Posting\Infographics;
use Intervention\Image\Facades\Image;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $dataId, $judul, $file, $fileGet, $status, $tipe;
    public $updateMode = false;

    public function render()
    {
        $datas = Infographics::latest()->paginate(5);
        $types = ArticleType::orderBy('name')->get();

        return view('livewire.p-a.infographics.index', [
            'datas' => $datas,
            'types' => $types,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'route' => 'admin.gallery-index',
                'title' => 'Daftar Infografis',
            ]);
    }

    public function resetInputFields()
    {
        $this->dataId = '';
        $this->judul = '';
        $this->file = '';
        $this->tipe = '';
    }

    public function store()
    {
        $validasi = $this->validate([
            'judul' => 'required',
            'tipe' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:15120',
        ]);

        if ($validasi) {
            $data = new Infographics;
            $data->title = $this->judul;
            $data->type_id = $this->tipe;
            $data->slug = Str::slug($this->judul);
            $data->status = 'Draft';
            if ($this->file) {
                $file = $this->file;
                $fileName = $data->slug . '.' . $file->getClientOriginalExtension();

                // ORIGINAL
                $destinationPath = public_path('/storage/infographics/original/');
                $img = Image::make($file->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $fileName, 100);

                // SMALL
                $destinationPath = public_path('/storage/infographics/small/');
                $img = Image::make($file->getRealPath());
                $QuploadImage = $img->resize(480, 480, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $fileName, 100);

                $data->filename = $fileName;
            }
            $data->save();
        }

        $this->showToastr('success','Infografis berhasil ditambahkan!');
        $this->resetInputFields();
        $this->emit('dataStore');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $data = Infographics::findOrFail($id);

        $this->tipe = $data->type_id;
        $this->dataId = $data->id;
        $this->judul = $data->title;
        $this->slug = $data->slug;
        $this->fileGet = $data->filename;
        $this->status = $data->status;
    }

    public function update()
    {
        $validasi = $this->validate([
            'judul' => 'required',
            'tipe' => 'required',
            'file' => 'nullable|image|mimes:jpeg,png,jpg|max:15120',
        ]);

        if ($validasi && $this->updateMode == true) {
            $data = Infographics::findOrFail($this->dataId);
            $data->title = $this->judul;
            $data->type_id = $this->tipe;
            $data->slug = Str::slug($this->judul);

            if ($this->file) {
                $file = $this->file;
                $fileName = $data->slug . '.' . $file->getClientOriginalExtension();

                // ORIGINAL
                $destinationPath = public_path('/storage/infographics/original/');
                $img = Image::make($file->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $fileName, 100);

                // SMALL
                $destinationPath = public_path('/storage/infographics/small/');
                $img = Image::make($file->getRealPath());
                $QuploadImage = $img->resize(480, 480, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $fileName, 100);

                $data->filename = $fileName;
            }

            $data->save();

            $this->updateMode = false;
            $this->showToastr('success','Infografis berhasil diperbarui!');
            $this->resetInputFields();
            $this->emit('dataStore');
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $data = Infographics::findOrFail($id);
        $data->delete();
        $this->showToastr('success','Infografis berhasil dihapus!');
    }

    public function changeStatus($id)
    {
        $data = Infographics::findOrFail($id);
        $oldStatus = $data->status;
        if ($oldStatus == 'Publish') {
            $data->status = 'Draft';
        } else {
            $data->status = 'Publish';
        }

        $data->save();
        $this->showToastr('success','Status berhasil diperbarui!');
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
