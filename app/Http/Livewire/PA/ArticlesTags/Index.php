<?php

namespace App\Http\Livewire\PA\ArticlesTags;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Articles\ArticleTags;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $tagId, $nama_tag;
    public $updateMode = false;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = ArticleTags::orderBy('name')->paginate(5);
        $bcs = [
            [
                'route' => 'admin.articles-tags-index',
                'title' => 'Daftar Tags Artikel',
            ],
        ];
        return view('livewire.p-a.articles-tags.index', [
            'datas' => $datas,
        ])->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Tags Artikel',
                'bcs' => $bcs
            ]);
    }

    private function resetInputFields()
    {
        $this->nama_tag = '';
    }

    public function store()
    {
        $validasi = $this->validate([
            'nama_tag' => 'required',
        ]);

        if ($validasi) {
            $data = new ArticleTags;
            $data->name = $this->nama_tag;
            $data->slug = Str::slug($this->nama_tag);
            $data->save();

            $this->showToastr('success', 'Berhasil', 'Tag berhasil ditambahkan.');

            $this->resetInputFields();
            $this->emit('closeModal'); // Close model to using to jquery
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $data = ArticleTags::findOrFail($id);

        $this->tagId = $id;
        $this->nama_tag = $data->name;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validasi = $this->validate([
            'nama_tag' => 'required',
        ]);

        if ($this->tagId) {
            $data = ArticleTags::findorFail($this->tagId);
            $data->name = $this->nama_tag;
            $data->slug = Str::slug($this->nama_tag);
            $data->save();

            $this->updateMode = false;
            $this->showToastr('success', 'Berhasil', 'Tag berhasil diperbarui.');
            $this->resetInputFields();
            $this->emit('closeModal'); // Close model to using to jquery
        }
    }

    public function delete($id)
    {
        if ($id) {
            ArticleTags::find($id)->delete();
            $this->showToastr('success', 'Berhasil', 'Tag berhasil dihapus.');
        }
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Jenis Artikel!',
            'text'        => "Anda yakin untuk menghapus Jenis Artikel ini?",
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
            'text'   => $text,
            'timeout' => 10000
        ]);
    }
}
