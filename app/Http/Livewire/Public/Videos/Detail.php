<?php

namespace App\Http\Livewire\Public\Videos;

use Livewire\Component;
use App\Models\Posting\Videos;

class Detail extends Component
{
    public $data;

    public function mount($slug)
    {
        $this->data = Videos::where('slug', $slug)->first();
        if (!$this->data) {
            return abort(404);
        }
    }

    public function render()
    {
        return view('livewire.public.videos.detail');
    }
}
