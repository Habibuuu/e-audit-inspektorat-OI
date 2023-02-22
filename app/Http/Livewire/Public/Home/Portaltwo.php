<?php

namespace App\Http\Livewire\Public\Home;

use Livewire\Component;
use App\Models\Util\Banners;
use App\Models\Util\MenuPortalTwos;
use App\Models\Posting\Infographics;

class Portaltwo extends Component
{
    public function render()
    {
        $banner = Banners::where('status', 'Publish')->latest()->first();
        $arrPortaltwos = MenuPortalTwos::where('status', 'Publish')->orderBy('sort')->get();
        $publikPortal = MenuPortalTwos::where('category_id', 2)->where('status', 'Publish')->orderBy('sort')->get();
        $pemerintahanPortal = MenuPortalTwos::where('category_id', 1)->where('status', 'Publish')->orderBy('sort')->get();
        $mtqToday = Infographics::where('type_id', 4)->where('status', 'Publish')->latest()->first();

        return view('livewire.public.home.portal', [
            'banner' => $banner,
            'arrPortal' => $arrPortaltwos,
            'publikPortal' => $publikPortal,
            'pemerintahanPortal' => $pemerintahanPortal,
            'mtqToday' => $mtqToday,
        ])
            ->layout('layouts.blank');
    }
}
