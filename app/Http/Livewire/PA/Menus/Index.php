<?php

namespace App\Http\Livewire\PA\Menus;

use App\Models\Posting\Page;
use Livewire\Component;
use App\Models\Util\Menus;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $dataId, $parentId, $nama, $url, $page_id, $sort, $status;
    public $type = 'page';
    public $updateMode = false;

    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $datas = Menus::where('parent_id', '0')->orderBy('sort')->paginate(5);
        $parents = Menus::where('parent_id', '0')->orderBy('name')->get();
        $pages = Page::orderBy('title')->get();

        $bcs = [
            [
                'route' => '',
                'title' => 'Menu',
            ],
        ];
        return view('livewire.p-a.menus.index', [
            'datas' => $datas,
            'parents' => $parents,
            'pages' => $pages,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Menu',
                'bcs' => $bcs
            ]);
    }

    public function resetInputFields()
    {
        $this->dataId = null;
        $this->nama = null;
        $this->parentId = null;
        $this->page_id = null;
        $this->url = null;
        $this->sort = null;
        $this->updateMode = false;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function store()
    {
        $validasi = $this->validate([
            'nama' => 'required',
            'parentId' => 'required',
            'type' => 'required',
            'sort' => 'required | numeric | min:1',
            'url' => 'required_if:type,url',
            'page_id' => 'required_if:type,page',
        ]);

        if ($validasi) {
            $data = new Menus;
            if ($this->type == 'page') {
                $page = Page::find($this->page_id);
                $data->page_id = $page->id;
                $this->url = url('/') . '/page/' . $page->slug;
            }
            $data->type = $this->type;
            $data->parent_id = $this->parentId;
            $data->sort = $this->sort;
            $data->url = $this->url;
            $data->name = $this->nama;
            $data->slug = Str::slug($this->nama);
            $data->status = "Draft";
            $data->save();

            $this->showToastr('success', 'Berhasil', 'Status berhasil ditambahkan!');
            $this->resetInputFields();
            $this->emit('closeModal');
        }
    }

    public function edit($id)
    {
        $this->resetErrorBag();
        $this->updateMode = true;
        $data = Menus::findOrFail($id);

        $this->dataId = $data->id;
        $this->parentId = $data->parent_id;
        $this->sort = $data->sort;
        $this->url = $data->url;
        $this->type = $data->type;
        $this->page_id = $data->page_id;
        $this->nama = $data->name;
        $this->status = $data->status;
    }

    public function update()
    {
        $validasi = $this->validate([
            'nama' => 'required',
            'parentId' => 'required',
            'type' => 'required',
            'sort' => 'required | numeric | min:1',
            'url' => 'required_if:type,url',
            'page_id' => 'required_if:type,page',
        ]);

        if ($validasi && $this->updateMode == true) {
            $data = Menus::findOrFail($this->dataId);
            $data->type = $this->type;
            if ($this->type == 'page') {
                $page = Page::find($this->page_id);
                $data->page_id = $page->id;
                $this->url = url('/') . '/page/' . $page->slug;
            }
            $data->parent_id = $this->parentId;
            $data->sort = $this->sort;
            $data->url = $this->url;
            $data->name = $this->nama;
            $data->slug = Str::slug($this->nama);
            $data->save();


            $this->showToastr('success', 'Berhasil', 'Menu berhasil diperbarui!');
            $this->emit('closeModal');
        }
    }

    public function delete($id)
    {
        $data = Menus::findOrFail($id);
        $data->delete();

        $this->showToastr('success', 'Berhasil', 'Status berhasil dihapus!');
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Menu!',
            'text'        => "Anda yakin untuk menghapus Menu ini?",
            'confirmText' => 'Hapus!',
            'cancelText' => 'Tidak!',
            'method'      => 'appointments:delete',
            'onConfirmed' => 'confirmed',
            'params'      => $dataId, // optional, send params to success confirmation
            'callback'    => '', // optional, fire event if no confirmed
        ]);
    }

    public function changeStatus($id)
    {
        $data = Menus::findOrFail($id);
        $oldStatus = $data->status;
        if ($oldStatus == 'Publish') {
            $data->status = 'Draft';
        } else {
            $data->status = 'Publish';
        }

        $data->save();

        $this->showToastr('success', 'Berhasil', 'Status berhasil diperbarui!');
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
