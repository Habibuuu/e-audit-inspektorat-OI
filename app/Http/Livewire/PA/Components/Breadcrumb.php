<?php

namespace App\Http\Livewire\PA\Components;

use Livewire\Component;

class Breadcrumb extends Component
{
    public $bcs;
    
    public function render()
    {
        return view('livewire.p-a.components.breadcrumb');
    }
}
