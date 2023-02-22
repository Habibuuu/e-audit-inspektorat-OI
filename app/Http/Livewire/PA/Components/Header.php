<?php

namespace App\Http\Livewire\PA\Components;

use Livewire\Component;

class Header extends Component
{
    public $user;

    public function render()
    {
        $this->user = auth()->user();

        return view('livewire.p-a.components.header');
    }
}
