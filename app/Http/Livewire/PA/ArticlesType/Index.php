<?php

namespace App\Http\Livewire\PA\ArticlesType;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Articles\ArticleType;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $jenisId, $nama_jenis, $parentId, $nama_parent;
    public $updateMode = false;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = ArticleType::orderBy('name')->paginate(5);
        $parents = ArticleType::where('parent_id', '0')->where('id', '!=', $this->jenisId)->get();
        $bcs = [
            [
                'route' => 'admin.articles-type-index',
                'title' => 'Daftar Jenis Artikel',
            ],
        ];

        return view('livewire.p-a.articles-type.index', [
            'datas' => $datas,
            'parents' => $parents,
        ])->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Jenis Artikel',
                'bcs' => $bcs
            ]);
    }

    private function resetInputFields()
    {
        $this->nama_jenis = '';
        $this->parentId = '0';
        $this->nama_parent = '';
    }

    public function store()
    {
        $validasi = $this->validate([
            'nama_jenis' => 'required',
            // 'parentId' => 'required',
        ]);

        if ($validasi) {
            $parId = 0;
            if ($this->parentId != 0) {
                $parId = $this->parentId;
            }
            $data = new ArticleType;
            $data->name = $this->nama_jenis;
            $data->slug = Str::slug($this->nama_jenis);
            $data->parent_id = $parId;
            $data->save();

            $this->showToastr('success', 'Jenis Artikel berhasil ditambahkan.');
            $this->resetInputFields();
            $this->emit('closeModal'); // Close model to using to jquery
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $data = ArticleType::findOrFail($id);

        $this->jenisId = $id;
        $this->nama_jenis = $data->name;
        $this->parentId = $data->parent_id;
        $this->parent_name = $data->Parent ? $data->Parent->name : 'ROOT';
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validasi = $this->validate([
            'nama_jenis' => 'required',
            'parentId' => 'required',
        ]);

        if ($this->jenisId) {
            $data = ArticleType::findorFail($this->jenisId);
            $data->name = $this->nama_jenis;
            $data->slug = Str::slug($this->nama_jenis);
            $data->parent_id = $this->parentId;
            $data->save();

            $this->updateMode = false;
            $this->showToastr('success', 'Jenis Artikel berhasil diperbarui.');
            $this->resetInputFields();
            $this->emit('closeModal'); // Close model to using to jquery
        }
    }

    public function delete($id)
    {
        if ($id) {
            ArticleType::find($id)->delete();
            $this->showToastr('success', 'Jenis Artikel berhasil dihapus.');
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
    public function showToastr($icon, $title)
    {
        $this->emit('swal:alert', [
            'icon'    => $icon,
            'title'   => $title,
            'timeout' => 10000
        ]);
    }
}
