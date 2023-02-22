<?php

namespace App\Http\Livewire\Public\Component;

use App\Models\Articles\Article;
use App\Models\Articles\ArticleCategory;
use App\Models\Articles\ArticleType;
use App\Models\Services\Service;
use App\Models\Articles\ArticleTags;
use Livewire\Component;

class Sidebar extends Component
{
    public $search;

    public function render()
    {
        $types = ArticleType::orderBy('name')->get();
        $categories = ArticleCategory::orderBy('name')->get();
        $arrRecommend = Article::where('is_recommend', 1)->inRandomOrder()->limit(5)->get();
        $arrRecent = Article::latest()->limit(3)->get();
        $services = Service::orderBy('name')->get();
        $arrTags = ArticleTags::orderBy('name')->get();

        $arrPengumuman = Article::where('type_id', '2')->orderBy('id', 'DESC')->limit(5)->get();
        $arrAgenda = Article::where('type_id', '3')->orderBy('id', 'DESC')->limit(5)->get();
        //make Popular recent month
        $arrPopuler = Article::where('type_id', '1')
        ->orderBy('view', 'DESC')
        ->whereYear('created_at', date('Y'))
        ->limit(5)->get();

        // dd($arrRecent);

        return view('livewire.public.component.sidebar',[
            'types' => $types,
            'categories' => $categories,
            'arrRecommend' => $arrRecommend,
            'arrRecent' => $arrRecent,
            'services' => $services,
            'arrTags' => $arrTags,
            'arrPengumuman' => $arrPengumuman,
            'arrAgenda' => $arrAgenda,
            'arrPopuler' => $arrPopuler,
        ]);
    }

    public function search()
    {
        $this->emit('search', $this->search);
    }
}
