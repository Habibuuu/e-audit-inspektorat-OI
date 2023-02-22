<?php

namespace App\Http\Livewire\Public\Layanan;

use App\Models\Services\Service;
use App\Models\Services\ServiceContent;
use Livewire\Component;

class Category extends Component
{
    public $service;

    public function mount($slug)
    {
        $this->service = Service::where('slug', $slug)->first();
    }

    public function render()
    {
        $datas = ServiceContent::where('service_id', $this->service->id)->get();
        return view('livewire.public.layanan.category',[
            'datas' => $datas,
        ]);
    }
}
