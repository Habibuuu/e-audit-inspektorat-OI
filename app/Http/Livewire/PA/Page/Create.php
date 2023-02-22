<?php

namespace App\Http\Livewire\PA\Page;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Posting\Page;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Create extends Component
{
    use WithFileUploads;
    public $judul_halaman, $slug, $isi_konten, $thumbnail, $lampiran;

    public function render()
    {
        $bcs = [
            [
                'route' => 'admin.page-index',
                'title' => 'Daftar Halaman',
            ],
            [
                'route' => 'admin.page-index',
                'title' => 'Buat Halaman',
            ],
        ];
        return view('livewire.p-a.page.create')
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Buat Halaman',
                'bcs' => $bcs
            ]);
    }

    public function updated($field)
    {
        if ($field == 'judul_halaman' && $this->slug == null) {
            $validate = $this->validateOnly('judul_halaman', ['judul_halaman' => 'required|unique:pages,title']);
            if ($validate) {
                $this->slug = Str::slug($this->judul_halaman);
            }
        }
    }

    public function store()
    {
        $validate = $this->validate([
            'judul_halaman' => 'required|unique:pages,title',
            'slug' => 'required|unique:pages,slug',
            'isi_konten' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'lampiran' => 'nullable|max:5',
            'lampiran.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,rar,zip,pdf,doc,docx,xls,xlsx|max:20000'
        ]);

        if ($validate) {
            $data = new Page;
            $data->title = $this->judul_halaman;
            $data->slug = Str::slug($this->judul_halaman);
            $data->user_id = auth()->user()->id;

            // DOM UPLOAD IMAGE ON SUMMERNOTE
            $domIsiArtikel = $this->isi_konten;
            $dom = new \DomDocument();
            $dom->loadHtml($domIsiArtikel, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $domImage = $dom->getElementsByTagName('img');

            if ($domImage && $domImage->length > 0) {
                foreach ($domImage as $k => $img) {
                    $domData = $img->getAttribute('src');
                    if (Str::startsWith($domData, 'data:')) {
                        list($type, $domData) = explode(';', $domData);
                        list($type, $domData) = explode(',', $domData);
                        $domData = base64_decode($domData);
                        $image_name = "/storage/images/" . time() . $k . '.png';
                        $path = public_path($image_name);
                        file_put_contents($path, $domData);
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $image_name);
                    }
                }
                $domIsiArtikel = $dom->saveHTML();
            }
            // DOM UPLOAD IMAGE ON SUMMERNOTE
            $data->content = $domIsiArtikel;

            if ($this->thumbnail) {
                $photo = $this->thumbnail;
                $imageName = 'page-' . Str::slug($this->judul_halaman) . '.' . $photo->getClientOriginalExtension();

                // ORIGINAL
                $destinationPath = public_path('/storage/images/thumbnail/original/');
                $img = Image::make($photo->getRealPath());
                $QuploadImage = $img->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $imageName, 100);

                // SMALL
                $destinationPath = public_path('/storage/images/thumbnail/small/');
                $img = Image::make($photo->getRealPath());
                $QuploadImage = $img->resize(480, 480, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $imageName, 100);

                $data->thumbnail = $imageName;
            }
            if ($this->lampiran) {
                $dataLampiran = [];
                foreach ($this->lampiran as $key => $lampiran) {
                    $filename = time() . $key . '.' . $lampiran->getClientOriginalExtension();
                    $lampiran->storeAs('lampiran', $filename, 'public');
                    $dataLampiran[] = $filename;
                }
                $data->lampiran = json_encode($dataLampiran);
            }
            $data->save();

            session()->flash('success', 'Halaman berhasil ditambahkan!');
            return redirect()->route('admin.page-index');
        }
    }
}
