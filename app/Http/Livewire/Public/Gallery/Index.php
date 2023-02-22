<?php

namespace App\Http\Livewire\Public\Gallery;

use App\Models\Posting\Gallery;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $arrGallery = Gallery::latest()->paginate(5);

        return view('livewire.public.gallery.index', [
            'arrGallery' => $arrGallery,
        ]);
    }
}
