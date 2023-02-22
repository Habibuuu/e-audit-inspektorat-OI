<?php

namespace App\Http\Controllers\Pub;

use Carbon\Carbon;
use App\Models\Util\Banners;
use Illuminate\Http\Request;
use App\Models\Articles\Article;
use App\Http\Controllers\Controller;
use App\Models\Articles\ArticleType;
use App\Models\Posting\Infographics;
use App\Models\Posting\Videos;
use App\Models\Settings\WebsIdentity;

class HomeController extends Controller
{
    public function landing()
    {
        $banner = Banners::where('status', 'Publish')->latest()->first();
        $identity = WebsIdentity::find(1);
        return view('public.landing',[
            'identity' => $identity,
            'banner' => $banner,
        ]);
    }

    public function index()
    {
        $identity = WebsIdentity::find(1);
        $banner = Banners::where('status', 'Publish')->latest()->first();
        $articleTypes = ArticleType::get();
        $articles = Article::where('status', 'Publish')->latest()->take(12)->get();
        $infographics = Infographics::where('status', 'Publish')->latest()->take(8)->get();
        $videos = Videos::where('status', 'Publish')->latest()->take(4)->get();

        return view('public.index',[
            'banner' => $banner,
            'identity' => $identity,
            'articleTypes' => $articleTypes,
            'articles' => $articles,
            'infographics' => $infographics,
            'videos' => $videos,
        ]);
    }

    public function articleDetail($slug)
    {
        $identity = WebsIdentity::find(1);
        $data = Article::where('slug', $slug)->where('status', 'Publish')->first();

        if ($data && $data->auto_publish == "1" && $data->published_at > Carbon::now()) {
            abort(404);
        }

        if($data)
        {
            return view('public.article.detail',[
                'identity' => $identity,
                'data' => $data,
            ]);
        }else {
            return abort(404);
        }
    }
}
