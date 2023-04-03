<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShortLinkDetail extends Component
{
    public $shortLink;
    public function render()
    {
        return view('livewire.short-link-detail');
    }


    
}
