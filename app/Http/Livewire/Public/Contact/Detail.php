<?php

namespace App\Http\Livewire\Public\Contact;

use Livewire\Component;

class Detail extends Component
{
    // public function render()
    // {
    //     $datas = Detail::latest()->paginate(5);
    //     return view('livewire.public.contact.detail', [
    //         'datas' => $datas,
    //     ])->layout('layouts.app');
    // }

    public function render()
    {
        return view('livewire.public.contact.detail');
    }
}
