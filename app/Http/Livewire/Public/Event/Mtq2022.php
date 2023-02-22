<?php

namespace App\Http\Livewire\Public\Event;

use App\Models\Articles\Article;
use App\Models\Posting\Infographics;
use Livewire\Component;
use Livewire\WithPagination;

class Mtq2022 extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchName, $searchCategory;
    public $limitPerPage = 10;
    public $loadMoreButton = true;

    protected $listeners = [
        'load-more' => 'loadMore',
    ];

    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 5;
    }


    public function render()
    {
        $mtqToday = Infographics::where('type_id', 4)->where('status','Publish')->latest()->first();
        $limitBerita = Article::where('type_id', 4)->where('status','Publish')->count();
        $arrBerita = Article::where('type_id', 4)->where('status','Publish')->paginate($this->limitPerPage);
        if ($limitBerita <= $arrBerita->count()) {
            $this->loadMoreButton = false;
        }
        // ->paginate($this->limitPerPage);

        return view('livewire.public.event.mtq2022', [
            'mtqToday' => $mtqToday,
            'arrBerita' => $arrBerita,
        ]);
    }
}
