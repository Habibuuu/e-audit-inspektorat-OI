<?php

namespace App\Http\Livewire\PA\Videos;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Posting\Videos;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dataId, $judul, $linkYoutube, $status;
    public $updateMode = false;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = Videos::latest()->paginate(10);
        $bcs = [
            [
                'route' => '',
                'title' => 'Video',
            ],
        ];
        return view('livewire.p-a.videos.index', [
            'datas' => $datas,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Video',
                'bcs' => $bcs
            ]);
    }

    public function resetInputFields()
    {
        $this->judul = '';
        $this->linkYoutube = '';
    }

    public function store()
    {
        $validasi = $this->validate([
            'judul' => 'required',
            'linkYoutube' => 'required',
        ]);
        if ($validasi) {
            $url = $this->linkYoutube;
            parse_str(parse_url($url, PHP_URL_QUERY), $youtube);
            $linkYt = $youtube['v'];

            $data = new Videos;
            $data->title = $this->judul;
            $data->slug = Str::slug($this->judul);
            $data->youtube_id = $linkYt;
            $data->status = "Draft";
            $data->save();

            $this->showToastr('success', 'Berhasil', 'Video berhasil ditambahkan.');

            $this->resetInputFields();

            $this->emit('closeModal');
        }
    }

    public function edit($id)
    {
        $this->resetErrorBag();
        $this->updateMode = true;
        $data = Videos::findOrFail($id);

        $this->dataId = $data->id;
        $this->judul = $data->title;
        $this->slug = $data->slug;
        $this->linkYoutube = 'https://www.youtube.com/watch?v=' . $data->youtube_id;
    }

    public function update()
    {
        $validasi = $this->validate([
            'judul' => 'required',
            'linkYoutube' => 'required',
        ]);
        if ($validasi && $this->updateMode == true) {
            $url = $this->linkYoutube;
            parse_str(parse_url($url, PHP_URL_QUERY), $youtube);
            $linkYt = $youtube['v'];

            $data = Videos::findOrFail($this->dataId);
            $data->title = $this->judul;
            $data->slug = Str::slug($this->judul);
            $data->youtube_id = $linkYt;
            $data->save();

            $this->updateMode = false;
            $this->showToastr('success', 'Berhasil', 'Video berhasil diperbarui.');
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
        $data = Videos::findOrFail($id);
        $data->delete();

        $this->showToastr('success', 'Berhasil', 'Video berhasil dihapus!');
    }

    public function changeStatus($id)
    {
        $data = Videos::findOrFail($id);
        $oldStatus = $data->status;
        if ($oldStatus == 'Publish') {
            $data->status = 'Draft';
        } else {
            $data->status = 'Publish';
        }

        $data->save();

        $this->showToastr('success', 'Berhasil', 'Status berhasil diperbarui!');
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Video!',
            'text'        => "Anda yakin untuk menghapus Video ini?",
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
