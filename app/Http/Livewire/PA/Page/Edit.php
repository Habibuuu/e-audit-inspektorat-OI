<?php

namespace App\Http\Livewire\PA\Page;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Posting\Page;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class Edit extends Component
{
    use WithFileUploads;
    public $judul_halaman, $slug, $isi_konten, $thumbnail, $lampiran, $lampiranPrev, $thumbPrev;
    protected $listeners = [
        'appointments:deleteThumbnail' => 'deleteThumbnail',
        'appointments:deleteLampiran' => 'deleteLampiran',
    ];

    public function mount($id)
    {
        $this->dataId = $id;
        $this->data = Page::find($id);
        $this->judul_halaman = $this->data->title;
        $this->slug = $this->data->slug;
        $this->lampiranPrev = collect(json_decode($this->data->lampiran));
        // dd($this->lampiranPrev);
        // dd($this->lampiranPrev);
        $this->isi_konten = $this->data->content;
        $this->thumbPrev = $this->data->thumbnail;
    }

    public function render()
    {
        $bcs = [
            [
                'route' => 'admin.page-index',
                'title' => 'Daftar Halaman',
            ],
            [
                'route' => 'admin.page-index',
                'title' => 'Edit Halaman',
            ],
        ];
        return view('livewire.p-a.page.edit')
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Edit Halaman',
                'bcs' => $bcs
            ]);
    }

    public function updated($field)
    {
        if ($this->slug == null || $this->slug == '' && $field == 'judul_halaman') {
            $validate = $this->validateOnly('judul_halaman', ['judul_halaman' => 'required|unique:pages,title,' . $this->dataId]);
            if ($validate) {
                $this->slug = Str::slug($this->judul_halaman);
            }
        }
    }

    public function update()
    {
        $validate = $this->validate([
            'judul_halaman' => 'required|unique:pages,title,' . $this->dataId,
            'slug' => 'required|unique:pages,slug,' . $this->dataId,
            'isi_konten' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'lampiran' => 'nullable|max:5',
            'lampiran.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,rar,zip,pdf,doc,docx,xls,xlsx|max:20000'
        ]);

        if ($validate) {
            $data = Page::find($this->dataId);
            $data->title = $this->judul_halaman;
            $data->slug = Str::slug($this->judul_halaman);
            $data->user_id = auth()->user()->id;

            // DOM UPLOAD IMAGE ON SUMMERNOTE
            $domIsiArtikel = $this->isi_konten;
            $dom = new \DomDocument();
            @$dom->loadHtml($domIsiArtikel, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
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
                $dataLampiran = json_decode($data->lampiran);

                foreach ($this->lampiran as $key => $lampiran) {
                    $filename = time() . $key . '.' . $lampiran->getClientOriginalExtension();
                    $lampiran->storeAs('lampiran', $filename, 'public');
                    $dataLampiran[] = $filename;
                }
                $data->lampiran = json_encode($dataLampiran);
            }
            $data->save();
            $this->mount($this->dataId);

            $this->showToastr('success', 'Berhasil!', 'Halaman berhasil diperbarui.');
        }
    }

    public function deleteThumbnail($id)
    {
        $data = Page::findOrFail($this->dataId);
        $data->thumbnail = null;
        $data->save();
        $this->mount($this->dataId);

        $this->showToastr('success', 'Berhasil', 'Thumbnail berhasil dihapus!');
    }

    public function confirmDeleteThumbnail($dataId = null)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Thumbnail!',
            'text'        => "Anda yakin untuk menghapus Thumbnail ini?",
            'confirmText' => 'Hapus!',
            'cancelText' => 'Tidak!',
            'method'      => 'appointments:deleteThumbnail',
            'onConfirmed' => 'confirmed',
            'params'      => $dataId, // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function deleteLampiran($key)
    {
        $data = Page::findOrFail($this->dataId);
        $lampiran = json_decode($data->lampiran);
        $lampiran = collect($lampiran);
        $lampiran->pull($key);
        // dd(json_encode($photos->flatten()));
        $newLampiran = json_encode($lampiran->flatten());
        $data->lampiran = $newLampiran;
        $data->save();

        $this->mount($this->dataId);

        $this->showToastr('success', 'Berhasil', 'Lampiran berhasil dihapus!');
    }

    public function confirmDeleteLampiran($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Lampiran!',
            'text'        => "Anda yakin untuk menghapus Lampiran ini?",
            'confirmText' => 'Hapus!',
            'cancelText' => 'Tidak!',
            'method'      => 'appointments:deleteLampiran',
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
            'text'   => $text,
            'timeout' => 10000
        ]);
    }
}
