<?php

namespace App\Http\Livewire;

use App\Models\ShortLink as ModelsShortLink;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Illuminate\Support\Str;
class ShortLink extends Component
{
    public $url;
    protected $listeners = ['shortLinkCreated'=> 'averiguarTitle'];

    public $shortLinks;
    public $currentShortLink;


    public function mount(){

        $this->getShortLinks();

    }

    public function getShortLinks(){
        $this->shortLinks = auth()->user()->shortLinks()->latest()->get();


        if(!$this->currentShortLink){
            $this->currentShortLink = $this->shortLinks->first();
        }


    }

    public function procesarUrl(){
        $this->validate([
            'url' => ['required', 'regex:/^(http|https)?(:\/\/)?(www\.)?[a-zA-Z0-9]+([\-\.]{1}[a-zA-Z0-9]+)*\.[a-zA-Z]{2,5}(:[0-9]{1,5})?(\/.*)?$/']
        ]);
        if (!preg_match("~^(?:f|ht)tps?://~i", $this->url)) {
            $this->url = "http://" . $this->url;
        }

        $shortLink = ModelsShortLink::create([
            'url'=>$this->url,
            'title'=>$this->url,
            'slug'=>Str::random(6),
            'user_id'=>auth()->id()
        ]);
        $this->getShortLinks();

        $this->emit('shortLinkCreated',$shortLink->id );

        $this->reset('url');
    }
    public function averiguarTitle(ModelsShortLink $shortLink ){

        try{
            $contents =file_get_contents($shortLink->url);

            if(preg_match("/<title>(.*)<\/title>/i", $contents, $matches)){
               $title = $matches[1];
            }
   
            $shortLink->update([
               'title'=> $title
            ]);

        }catch(Exception $e){

        }
         
    }
    public function changeShortLink($shortLinkId){
        $this->currentShortLink = ModelsShortLink::find($shortLinkId);
    }
    public function render()
    {
        return view('livewire.short-link');
    }
}
