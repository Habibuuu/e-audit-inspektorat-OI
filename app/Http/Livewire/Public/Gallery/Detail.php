<?php

namespace App\Http\Livewire\Public\Gallery;

use App\Models\Posting\Gallery;
use Livewire\Component;

class Detail extends Component
{
    public $data;

    public function mount($slug)
    {
        $this->data = Gallery::where('slug', $slug)->first();
        if (!$this->data) {
            return abort(404);
        }
    }

    public function render()
    {
        return view('livewire.public.gallery.detail');
    }
}
