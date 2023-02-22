<?php

namespace App\Http\Livewire\Public\Page;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pages\Pages;
use App\Models\Pages\PagesCategory;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $kategori;
    public $limitPerPage = 10;
    public $loadMoreButton = true;

    protected $listeners = [
        'load-more' => 'loadMore',
        'search' => 'search',
    ];
    protected $queryString = [
        'search',
        'kategori',
    ];

    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 5;
    }

    public function search($search)
    {
        $this->search = $search;
    }

    public function render()
    {
        $kategori = null;
        if ($this->kategori) {
            $kategori = PagesCategory::where('slug', $this->kategori)->first()->id;
        }

        $limitPages = Pages::where('status', 'Post')->count();
        $arrPages = Pages::where('status', 'Post')
        ->where('title', 'LIKE', '%' . $this->search . '%')
            ->when($kategori, function ($q) use ($kategori) {
                $q->where('category_id', $kategori);
            })
            ->latest()
            ->paginate($this->limitPerPage);

        if ($limitPages <= $arrPages->count() || $arrPages->count() == 0) {
            $this->loadMoreButton = false;
        }

        return view('livewire.public.page.index', [
            'arrPages' => $arrPages,
        ]);

    }
}
