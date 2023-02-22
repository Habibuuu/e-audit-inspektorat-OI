<?php

namespace App\Http\Livewire\PA\Articles;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Articles\Article;
use App\Models\Articles\ArticleType;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $filterJudul, $filterJenis;
    protected $listeners = [
        'appointments:delete' => 'delete',
    ];

    public function render()
    {
        $filterJudul = $this->filterJudul;
        $filterJenis = $this->filterJenis;
        $datas = Article::latest('published_at')
            ->when($filterJudul, function ($query) use ($filterJudul) {
                return $query->where('title', 'like', '%' . $filterJudul . '%');
            })
            ->when($filterJenis, function ($query) use ($filterJenis) {
                return $query->where('type_id', $filterJenis);
            })
            ->paginate(5);

        $arrJenis = ArticleType::orderBy('name')->get();

        $bcs = [
            [
                'route' => 'admin.articles-index',
                'title' => 'Daftar Artikel',
            ],
        ];
        return view('livewire.p-a.articles.index', [
            'datas' => $datas,
            'arrJenis' => $arrJenis,
        ])->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Daftar Artikel',
                'bcs' => $bcs
            ]);
    }

    public function filter()
    {
    }

    public function resetFilter()
    {
        $this->filterJudul = '';
        $this->filterJenis = '';
    }

    public function delete($id)
    {
        $data = Article::findOrFail($id);
        $data->delete();

        $this->showToastr('success', 'Artikel berhasil dihapus!');
    }

    public function confirmDelete($dataId)
    {
        $this->emit("swal:confirm", [
            'icon'        => 'warning',
            'title'       => 'Hapus Artikel!',
            'text'        => "Anda yakin untuk menghapus Artikel ini?",
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
        $data = Article::findOrFail($id);
        $oldStatus = $data->status;
        if ($oldStatus == 'Publish') {
            $data->status = 'Draft';
        } elseif ($oldStatus == 'Draft') {
            $data->status = 'Publish';
        }
        $data->save();
        $this->showToastr('success', 'Status berhasil diperbarui!');
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
