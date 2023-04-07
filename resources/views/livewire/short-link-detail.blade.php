<div  class="px-4 py-8">

    <div class="bg-white shadow-xl rounded-lg p-6 mb-8">
        <h2 class="text-xl font-semibold"> {{$shortLink->title}}
        </h2>
        <p class="my-2">  
            <i class="fa-regular fa-calendar"></i>
              {{$shortLink->created_at->format('F d, Y h:i A')}}  by   {{$shortLink->user->name}}

        </p>

        <p>

            <i class="fa-solid fa-chart-simple mr-1"></i>
            {{$shortLink->visits->count()}} visitas


        </p>
    </div>


    <div class="bg-white shadow-xl rounded-lg p-6">

        <div class="flex justify-between items-center" x-data="{
            url:'{{route('shortLink.show',$shortLink->slug)}}',
            copied: false,
            copyToClipboard(){
                let input = document.createElement('input');
                input.setAttribute('type','text');
                input.setAttribute('value',this.url);

                document.body.appendChild(input);

                input.select();

                document.execCommand('copy');

                document.body.removeChild(input);

                this.copied = true;
                setTimeout(()=>{
                    this.copied = false;

                }, 2000)

            }
        }">
            <a href="{{route('shortLink.show',$shortLink->slug)}}" class="text-lg text-blue-600 font-semibold" target="__blank">
                {{route('shortLink.show',$shortLink->slug)}}
            </a>
            <button class="bg-gray-100 px-4 py-2 rounded-lg shadow-lg" x-on:click="copyToClipboard()">
                <i class="fa-solid fa-copy mr-2"></i> <span x-text="copied ? '¡Copiado!' : 'Copiar'"></span>
            </button>
        </div>


        <p>{{$shortLink->visits->count()}} clicks</p>

        <div class="flex items-center ">
            <i class="fa-solid fa-turn-up rotate-90 mr-2"></i>
            <a href="{{$shortLink->url}}" target="__blank">{{$shortLink->url}}</a>

        </div>

        <div>
            <h2 class="text-lg font-semibold"> QR CODE</h2>
        </div>
        <div class="flex">
            {!! QrCode::size(100)->generate(route('shortLink.show',$shortLink->slug)); !!}


            <x-button class="ml-4" wire:click="downloadQR">

                <i class="fa-solid fa-download mr-2"></i>Descargar


            </x-button>

        </div>

        
    </div>
    
</div>
