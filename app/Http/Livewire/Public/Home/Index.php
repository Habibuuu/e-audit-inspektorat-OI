<?php

namespace App\Http\Livewire\Public\Home;

use App\Models\Link;
use Livewire\Component;
use App\Models\Util\Banners;
use App\Models\Posting\Videos;
use App\Models\Articles\Article;
use App\Models\Contacts\Contact;
use App\Models\Util\MenuPortals;
use App\Models\Articles\ArticleTags;
use App\Models\Articles\ArticleCategory;
use App\Models\Articles\ArticleType;
use App\Models\Posting\Gallery;

class Index extends Component
{

    public function render()
    {
        $arrBanner = Banners::where('status', 'Publish')->orderBy('id', 'ASC')->get();
        $arrPortal = MenuPortals::where('status', 'Publish')->latest()->get();
        $arrBeritaBanner = Article::where('category_id', '1')->where('type_id', '1')->orderBy('id', 'DESC')->limit(3)->get();
        $arrBerita = Article::where('type_id' , '1')->orderBy('published_at', 'DESC')->paginate(5);
        $arrBeritaTer = Article::where('type_id', '1')->orderBy('published_at', 'DESC')->limit(3)->get();
        $arrBeritaOne = Article::orderBy('id', 'DESC')->limit(10)->get();
        $arrPengumuman = Article::where('type_id', '2')->orderBy('id', 'DESC')->limit(5)->get();
        $arrAgenda = Article::where('type_id', '3')->orderBy('id', 'DESC')->limit(5)->get();
        //make Popular recent month
        $arrPopuler = Article::where('type_id', '1')
        ->orderBy('view', 'DESC')
        ->whereYear('published_at', date('Y'))
        ->limit(5)->get();

        $arrTags = ArticleTags::orderBy('name')->get();
        $arrCategory = ArticleCategory::orderBy('name')->get();
        $arrType = ArticleType::orderBy('name')->get();
        $arrVideos = Videos::orderBy('id', 'DESC')->limit(5)->get();
        $arrContact = Contact::where('status', 'Publish')->latest()->get();
        $arrLink = Link::where('status', 'Publish')->orderBy('id', 'ASC')->get();
        $arrGallery = Gallery::latest()->paginate(5);
        $arrArticle = Article::orderBy('id', 'DESC')->limit(4)->get();

        // dd($arrPengumuman);
        return view('livewire.public.home.index',[
            'arrBanner' => $arrBanner,
            'arrPortal' => $arrPortal,
            'arrBerita' => $arrBerita,
            'arrBeritaTer' => $arrBeritaTer,
            'arrBeritaOne' => $arrBeritaOne,
            'arrBeritaBanner' => $arrBeritaBanner,
            'arrPengumuman' => $arrPengumuman,
            'arrAgenda' => $arrAgenda,
            'arrPopuler' => $arrPopuler,
            'arrTags' => $arrTags,
            'arrCategory' => $arrCategory,
            'arrType' => $arrType,
            'arrVideos' => $arrVideos,
            'arrContact' => $arrContact,
            'arrLink' => $arrLink,
            'arrGallery' => $arrGallery,
            'arrArticle' => $arrArticle,
        ]);
    }
}
