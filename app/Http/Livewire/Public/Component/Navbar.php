<?php

namespace App\Http\Livewire\Public\Component;

use App\Models\Articles\Article;
use Livewire\Component;

class Navbar extends Component
{
    public $search;

    public function render()
    {
        $arrBerita = Article::where('status', 'Publish')
            ->where('title', 'LIKE', '%' . $this->search . '%')
            ->latest()
            ->paginate(5);

        return view('livewire.public.component.navbar',[
            'arrBerita' => $arrBerita,
        ]);
    }

    public function search()
    {
        $this->emit('search', $this->search);
    }
}
