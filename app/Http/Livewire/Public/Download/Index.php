<?php

namespace App\Http\Livewire\Public\Download;

use Livewire\Component;
use App\Models\Download;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $searchTerm;

    /*
     * Reset pagination when doing a search
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = '%'.$this->searchTerm.'%';

        $datas = Download::latest()->where('status', 'Publish')->paginate(5);

        $this->applySearchFilter($datas);

        return view('livewire.public.download.index', [
            //'datas' => $datas,
            'datas'	=>	Download::where(function($sub_query){
                $sub_query->where('title', 'like', '%'.$this->searchTerm.'%');
            })->paginate(10)
        ]);
    }

    private function applySearchFilter($datas)
    {
        if ($this->search) {
            return $datas->where("title LIKE \"%$this->search%\"");
        }

        return null;
    }

}
