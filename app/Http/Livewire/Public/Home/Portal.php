<?php

namespace App\Http\Livewire\Public\Home;

use Livewire\Component;
use App\Models\Util\Banners;
use App\Models\Util\MenuPortals;
use App\Models\Posting\Infographics;
use App\Models\Util\MenuPortalTwos;
use App\Models\PortalNews;

class Portal extends Component
{
    public function render()
    {
        $banner = Banners::where('status', 'Publish')->latest()->first();
        $arrPortal = MenuPortals::where('status', 'Publish')->orderBy('sort')->get();
        $publikPortal = MenuPortals::where('category_id', 2)->where('status', 'Publish')->orderBy('sort')->get();
        $pemerintahanPortal = MenuPortals::where('category_id', 1)->where('status', 'Publish')->orderBy('sort')->get();
        $mtqToday = Infographics::where('type_id', 4)->where('status', 'Publish')->latest()->first();
        $arrPortaltwos = MenuPortalTwos::where('status', 'Publish')->orderBy('sort')->get();
        $portals = PortalNews::where('status', 'Publish')
                ->where('parent_id', 0)
                ->orderBy('sort')
                ->get();

        return view('livewire.public.home.portal', [
            'banner' => $banner,
            'arrPortal' => $arrPortal,
            'arrPortaltwos' => $arrPortaltwos,
            'publikPortal' => $publikPortal,
            'pemerintahanPortal' => $pemerintahanPortal,
            'mtqToday' => $mtqToday,
            'portals' => $portals,
        ])
            ->layout('layouts.portal');
    }
}
