<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShortLinkDetail extends Component
{
    public $shortLink;

    public function downloadQR(){

        $qr_code = QrCode::size(100)->generate(route('shortLink.show',$this->shortLink->slug));


        Storage::put('qr_codes/'.$this->shortLink->slug.'.svg',$qr_code);


        return  Storage::download('qr_codes/'.$this->shortLink->slug.'.svg');

    }


    public function render()
    {
        return view('livewire.short-link-detail');
    }


    
}
