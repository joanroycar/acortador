<div>

    <div class="bg-white shadow-xl rounded p-6 mb-12">

        <div class="flex">
            <x-input type="text" wire:model="url" class="w-full" placeholder="Ingrese la url que quiere acortar" />
            <x-button class="ml-4" wire:click="procesarUrl()">
                Acortar
            </x-button>
          

        </div>

        <x-input-error for="url" class="mt-2"/>
    </div>

    @if ($shortLinks->count())
    <div class="bg-gray-50 shadow-xl rounded-lg">
        <div class="grid grid-cols-4 divide-x divide-gray-200">
            <div class="col-span-1 ">

                <div class="px-4 py-2 border-b ">
                    <p class="font-semibold">{{$shortLinks->count()}} url's Encontrada</p>

                </div>

                <ul class="divide-y divide-gray-200">
                    @foreach ($shortLinks as $shortLink)
                    {{-- <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer" wire:click="seleccionarUrl()">
                        {{$shortLink->url}}
                    </li> --}}

                    <li class="p-4 cursor-pointer {{$shortLink->id == $currentShortLink->id ?'bg-blue-100': ''}}" wire:click="changeShortLink({{$shortLink->id}})">
                        <p class="text-xs">{{$shortLink->created_at->format('d M Y')}}</p>
                        <p class="whitespace-nowrap overflow-hidden text-ellipsis">{{$shortLink->title}}</p>

                        <div class="flex justify-between items-center">
                            <a href="{{route('shortLink.show',$shortLink->slug)}}" class="text-xs text-red-500 font-semibold" target="__blank">
                                {{route('shortLink.show',$shortLink->slug)}}
                            </a>
                            <span class="text-sm"> {{$shortLink->visits->count()}}
                                <i class="fa-solid fa-chart-simple ml-1"></i>
                            </span>
                        </div>
                        
                    </li>
                    
                    @endforeach
                </ul>

            </div>


            <div class="col-span-3">
            @livewire('short-link-detail',['shortLink'=>$currentShortLink],key($currentShortLink->id))

            </div>

            

        </div>
    </div>

    @else
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 text-red-400" role="alert">
        <span class="font-medium">No existe!</span> ninguna Urls Acortadas.
      </div>


    @endif





</div>
