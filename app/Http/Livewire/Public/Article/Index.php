<?php

namespace App\Http\Livewire\Public\Article;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Articles\Article;
use App\Models\Articles\ArticleCategory;
use App\Models\Articles\ArticleType;
use Illuminate\Support\Collection;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $kategori, $jenis;
    public $limitPerPage = 10;
    public $loadMoreButton = true;

    protected $listeners = [
        'load-more' => 'loadMore',
        'search' => 'search',
    ];
    protected $queryString = [
        'search',
        'jenis',
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
        $jenis = null;
        if ($this->kategori) {
            $kategori = ArticleCategory::where('slug', $this->kategori)->first()->id;
        }
        if ($this->jenis) {
            $jenis = ArticleType::where('slug', $this->jenis)->first()->id;
        }

        $limitBerita = Article::where('status', 'Publish')->count();
        $arrBerita = Article::with('Author')->where('status', 'Publish')
            ->orderBy('published_at', 'DESC')
            ->where('title', 'LIKE', '%' . $this->search . '%')
            ->when($kategori, function ($q) use ($kategori) {
                $q->where('category_id', $kategori);
            })
            ->when($jenis, function ($q) use ($jenis) {
                $q->where('type_id', $jenis);
            })
            ->latest()
            ->get();
        // dd($arrBerita);

        if ($limitBerita <= $arrBerita->count() || $arrBerita->count() == 0) {
            $this->loadMoreButton = false;
        }

        $artikel = Article::with('Author')->get();

        $collection = new Collection($arrBerita);

        $mapped = $collection->map(function ($item) {
            return [
                "id" => $item->id,
                "type_id" => $item->Type->name,
                "category_id" => $item->Category->name,
                'user_id' => $item->Author->fullname,
                "title" => $item->title,
                "slug" => $item->slug,
                "thumbnail" => $item->thumbnail,
                "description" => $item->description,
                "content" => $item->content,
                "status" => $item->status,
                "view" => $item->view,
                "is_recommend" => $item->is_recommend,
                "is_auto_publish" => $item->is_auto_publish,
                "published_at" => $item->published_at,
                "deleted_at" => $item->deleted_at,
                "created_at" => $item->created_at,
                "updated_at" => $item->updated_at,
            ];
        });

        // dd($mapped);

        return view('livewire.public.article.index', [
            'arrBerita' => $arrBerita,
            'mapped' => $mapped,
        ]);
    }
}
