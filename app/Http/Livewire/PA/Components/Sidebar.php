<?php

namespace App\Http\Livewire\PA\Components;

use Livewire\Component;

class Sidebar extends Component
{
    public $user;

    public function render()
    {
        $this->user = auth()->user();

        return view('livewire.p-a.components.sidebar');
    }
}
