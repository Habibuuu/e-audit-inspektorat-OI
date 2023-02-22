<?php

namespace App\Http\Livewire\Public\Videos;

use Livewire\Component;
use App\Models\Posting\Videos;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $arrVideos = Videos::latest()->paginate(10);

        return view('livewire.public.videos.index',[
            'arrVideos' => $arrVideos,
        ]);
    }
}
