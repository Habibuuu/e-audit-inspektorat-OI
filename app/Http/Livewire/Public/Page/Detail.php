<?php

namespace App\Http\Livewire\Public\Page;

use Livewire\Component;
use App\Models\Pages\Pages;

class Detail extends Component
{
    public $data;

    public function mount($slug)
    {
        $this->data = Pages::where([
            ['slug', $slug],
            ['status', 'Post'],
        ])->first();
        // dd($data);
        if (!$this->data) {
            return abort(404);
        }
    }

    public function render()
    {
        return view('livewire.public.page.detail');
    }
}
