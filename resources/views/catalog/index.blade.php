<x-layout>
    <div class="w-3/4 my-10 mx-auto">

        <h1 class="text-5xl text-gray-500 mb-10">{{$title}}</h1>

        <div class="w-100 grid grid-cols-4 grid-rows-2 gap-6">
            @foreach ($offers as $offer)
                <div class="bg-backgroundl rounded-xl p-4 text-white border border-background hover:border-primary relative">
                    <div class="w-100 h-auto relative mb-2 user-offers-aspect">
                        <a href="/offer/{{$offer->id}}">
                        <img src="{{$offer->cover ? asset('storage/' . $offer->cover) : asset('/images/no-image.png')}}" alt="Okładka oferty" class="absolute top-0 left-0 w-full h-full object-cover rounded-lg">
                        </a>
                    </div>
                    <a href="">
                        <p class="text-sm text-primary hover:text-secondary">{{$offer->user->username}}</p>
                    </a>
                    <a href="/offer/{{$offer->id}}">
                        <h3 class="text-lg hover:underline">{{$offer->title}}</h3>
                    </a>
                    <p class="text-md">{{$offer->localization}}</p>
                    <p class="font-bold">{{$offer->price}}zł / {{$offer->price_type}}</p>
                </div>
            @endforeach
        </div>

    </div>
</x-layout>
