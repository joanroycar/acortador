<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShortLinkController extends Controller
{
    public function index(ShortLink $shortLink){

        // $ip = request()->ip();

        $ip = env('APP_ENV') == 'local' ? '193.46.121.100' :request()->ip();

        // return $ip;
        $ipInfo= Http::get('http://ip-api.com/json/'.$ip)->object();


        Visit::create([
            'country'=> $ipInfo->country,
            'short_link_id'=>$shortLink->id,

        ]);

        // return $ipInfo;


        return redirect($shortLink->url);
    }
}
