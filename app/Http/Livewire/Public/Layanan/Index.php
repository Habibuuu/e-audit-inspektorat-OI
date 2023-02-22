<?php

namespace App\Http\Livewire\Public\Layanan;

use App\Models\Services\Service;
use App\Models\Services\ServiceCategory;
use Livewire\Component;

class Index extends Component
{
    public $searchName, $searchCategory;

    public function render()
    {
        $searchCategory = $this->searchCategory;
        $searchName = $this->searchName;

        $datas = Service::orderBy('name')
            ->when($searchCategory, function ($q) use ($searchCategory) {
                $q->where('category_id', $searchCategory);
            })
            ->where('name', 'LIKE', '%'.$searchName.'%')
            ->get();

        $categories = ServiceCategory::orderBy('name')->get();

        return view('livewire.public.layanan.index', [
            'datas' => $datas,
            'categories' => $categories,
        ]);
    }
}
