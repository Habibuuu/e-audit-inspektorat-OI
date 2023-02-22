<?php

namespace App\Http\Livewire\Public\Home;

use Livewire\Component;
use App\Models\Util\Banners;
use App\Models\Util\MenuPortals;
use App\Models\Posting\Infographics;

class Landing extends Component
{
    public function render()
    {
        $banner = Banners::where('status', 'Publish')->latest()->first();
        $arrPortal = MenuPortals::where('status', 'Publish')->orderBy('sort')->get();
        $mtqToday = Infographics::where('type_id', 4)->where('status','Publish')->latest()->first();

        return view('livewire.public.home.landing',[
            'banner' => $banner,
            'arrPortal' => $arrPortal,
            'mtqToday' => $mtqToday,
        ])
        ->layout('layouts.blank');
    }
}
