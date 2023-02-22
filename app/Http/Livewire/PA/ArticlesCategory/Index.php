<?php

namespace App\Http\Livewire\PA\ArticlesCategory;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Articles\ArticleCategory;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $categoryId, $nama_kategori, $parentId, $nama_parent;
    public $updateMode = false;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = ArticleCategory::orderBy('name')->paginate(5);
        $parents = ArticleCategory::where('parent_id', '0')->where('id', '!=', $this->categoryId)->get();

        $bcs = [
            [
                'route' => 'admin.articles-category-index',
                'title' => 'Daftar Kategori',
            ],
        ];
        return view('livewire.p-a.articles-category.index', [
            'datas' => $datas,
            'parents' => $parents,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Kategori',
                'bcs' => $bcs
            ]);
    }

    private function resetInputFields()
    {
        $this->nama_kategori = '';
        $this->parentId = '0';
        $this->nama_parent = '';
    }

    public function store()
    {
        $validasi = $this->validate([
            'nama_kategori' => 'required',
            // 'parentId' => 'required',
        ]);

        if ($validasi) {
            $parId = 0;
            if ($this->parentId != 0) {
                $parId = $this->parentId;
            }
            $data = new ArticleCategory;
            $data->name = $this->nama_kategori;
            $data->slug = Str::slug($this->nama_kategori);
            $data->parent_id = $parId;
            $data->save();

            $this->showToastr('success', 'Kategori berhasil ditambahkan.');
            $this->resetInputFields();
            $this->emit('closeModal'); // Close model to using to jquery
        }
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $data = ArticleCategory::findOrFail($id);

        $this->categoryId = $id;
        $this->nama_kategori = $data->name;
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
            'nama_kategori' => 'required',
            'parentId' => 'required',
        ]);

        if ($this->categoryId) {
            $data = ArticleCategory::findorFail($this->categoryId);
            $data->name = $this->nama_kategori;
            $data->slug = Str::slug($this->nama_kategori);
            $data->parent_id = $this->parentId;
            $data->save();

            $this->updateMode = false;
            $this->showToastr('success', 'Kategori berhasil diperbarui.');
            $this->resetInputFields();
            $this->emit('closeModal'); // Close model to using to jquery
        }
    }

    public function delete($id)
    {
        if ($id) {
            ArticleCategory::find($id)->delete();
            $this->showToastr('success', 'Kategori berhasil dihapus.');
        }
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Kategori!',
            'text'        => "Anda yakin untuk menghapus Kategori ini?",
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
