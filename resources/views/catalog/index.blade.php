<x-layout>
    <div class="w-3/4 my-10 mx-auto">

        <h1 class="text-5xl text-gray-500 mb-10">{{$title}}</h1>

        <div class="flex flex-row gap-6">

            <div class="flex flex-col w-1/5">
                <form action="{{ url()->current() }}" method="GET" class="flex flex-col">
                    
                    <label class="text-sm" for="miejsce">Szukaj:</label>
                    <input type="text" name="query" 
                            placeholder="Tytuł..." 
                            value="{{ request()->get('query') }}"
                            class="bg-background border border-primary px-4 py-2 mt-2 mb-4 rounded-xl focus:outline-none focus:border-secondary">
                    
                    {{-- TODO select z miejscowościami--}}
                    <label class="text-sm" for="miejsce" class="">Miejsce:</label>
                    <input type="text" name="miejsce" 
                            placeholder="Miejsce..." 
                            value="{{ request()->get('miejsce') }}"
                            class="bg-background border border-primary px-4 py-2 mt-2 mb-4 rounded-xl focus:outline-none focus:border-secondary">

                    <label class="text-sm" for="cena_min" class="whitespace-nowrap">Cena minimalna:</label>
                    <input type="number" name="cena_min" 
                            placeholder="Cena min..." 
                            value="{{ request()->get('cena_min') }}"
                            class="bg-background border border-primary px-4 py-2 mt-2 mb-4 rounded-xl focus:outline-none focus:border-secondary">

                    <label class="text-sm" for="cena_max" class="whitespace-nowrap">Cena maksymalna:</label>
                    <input type="number" name="cena_max" 
                            placeholder="Cena max..." 
                            value="{{ request()->get('cena_max') }}"
                            class="bg-background border border-primary px-4 py-2 mt-2 mb-4 rounded-xl focus:outline-none focus:border-secondary">

                    <label class="text-sm" for="sorttitle" class="whitespace-nowrap">Sortuj A-Z:</label>
                    <select name="sorttitle" id="sorttitle" class="px-4 py-2 mt-2 mb-4 rounded-xl bg-background border border-primary focus:outline-none focus:border-secondary">
                        <option value="">-</option>
                        <option value="asc">od A do Z</option>
                        <option value="desc">od Z do A</option>
                    </select>

                    <label class="text-sm" for="sortprice" class="whitespace-nowrap">Sortuj cena:</label>
                    <select name="sortprice" id="sortprice" class="px-4 py-2 mt-2 mb-4 rounded-xl bg-background border border-primary focus:outline-none focus:border-secondary">
                        <option value="">-</option>
                        <option value="asc">rosnąco</option>
                        <option value="desc">malejąco</option>
                    </select>
                    
                    <div class="flex flex-row gap-6">
                        <button type="submit" class="w-1/2 filters-buttons rounded-xl px-2 py-1 bg-primary text-backgroundll"><i class="fa-solid fa-magnifying-glass"> <span>Filtruj</span></i></button>
                        <a href="{{ url()->current() }}" class="w-1/2 filters-buttons rounded-xl px-2 py-1 bg-danger text-center"><i class="fa-solid fa-xmark"></i> <span>Usuń</span></i></a>
                    </div>
                </form>
            </div>

            <div class="w-4/5">
                <div class="grid grid-cols-4 grid-rows-2 gap-6 mb-6">
                    @foreach ($offers as $offer)
                        <div class="bg-backgroundl rounded-xl p-4 text-white border border-background hover:border-primary relative">
                            <div class="w-100 h-auto relative mb-2 user-offers-aspect">
                                <a href="{{ route('catalog.showSingle', ['id' => $offer->id]) }}">
                                <img src="{{$offer->cover ? asset('storage/' . $offer->cover) : asset('/images/no-image.png')}}" alt="Okładka oferty" class="absolute top-0 left-0 w-full h-full object-cover rounded-lg">
                                </a>
                            </div>
                            <a href="{{ route('user.show', ['username' => $offer->user->username]) }}">
                                <p class="text-sm text-primary hover:text-secondary">{{$offer->user->username}}</p>
                            </a>
                            <a href="{{ route('catalog.showSingle', ['id' => $offer->id]) }}">
                                <h3 class="text-lg hover:underline">{{$offer->title}}</h3>
                            </a>
                            <p class="text-md">{{$offer->localization}}</p>
                            <p class="font-bold">{{$offer->price}}zł / {{$offer->price_type}}</p>
                        </div>
                    @endforeach
                </div>

                <div>
                    {{-- TODO style pagination --}}
                    {{ $offers->links() }}
                </div>
            </div>

        </div>

    </div>
</x-layout>

<script src="{{ asset('js/offersFiltersOld.js') }}"></script>