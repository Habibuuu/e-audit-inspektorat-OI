<?php

namespace App\Http\Livewire\Public\Article;

use App\Models\Articles\Article;
use Livewire\Component;

class Detail extends Component
{
    public $data;

    public function mount($slug)
    {
        $this->data = Article::where('slug', $slug)->first();
        if(!$this->data)
        {
            return abort(404);
        }
        else {
            $this->data->view = $this->data->view + 1;
            $this->data->save();
        }
    }

    public function render()
    {
        return view('livewire.public.article.detail');
    }
}
