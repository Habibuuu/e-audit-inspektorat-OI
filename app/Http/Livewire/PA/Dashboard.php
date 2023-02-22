<?php

namespace App\Http\Livewire\PA;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Visitors;
use Carbon\CarbonPeriod;
use App\Models\Posting\Videos;
use App\Models\Articles\Article;
use App\Models\Articles\ArticleTags;
use App\Models\Articles\ArticleType;
use App\Models\Posting\Infographics;
use App\Models\Articles\ArticleCategory;
use App\Models\Posting\Download;
use App\Models\Posting\Gallery;
use App\Models\Posting\Page;

class Dashboard extends Component
{
    public $visitorRange = 'last_month';
    public function render()
    {
        $charts = [];
        if ($this->visitorRange == 'last_month') {
            $dateRange = CarbonPeriod::create(Carbon::now()->subMonth(), Carbon::now());
        } elseif ($this->visitorRange == 'last_week') {
            $dateRange = CarbonPeriod::create(Carbon::now()->subWeek(), Carbon::now());
        }

        foreach ($dateRange as $date) {
            $visitor = Visitors::whereDate('date', $date->format('Y-m-d'))->count();
            $charts[] = [
                'date' => $date->isoFormat('DD MMM YY'),
                'value' => $visitor
            ];
        }

        return view('livewire.p-a.dashboard', [
            'articleCount' => Article::where('status', 'Publish')->count(),
            'articleCategoryCount' => ArticleCategory::count(),
            'articleTypeCount' => ArticleType::count(),
            'articleTagCount' => ArticleTags::count(),
            'infographicCount' => Infographics::count(),
            'videoCount' => Videos::count(),
            'halamanCount' => Page::count(),
            'albumCount' => Gallery::count(),
            'videoCount' => Videos::count(),
            'berkasCount' => Download::count(),
            'charts' => $charts,
        ])
            ->layout('admin.layouts.app')
            ->layoutData([
                'title' => 'Dashboard',
                'description' => '',
                'keywords' => '',
                'active' => '',
            ]);
    }
}
