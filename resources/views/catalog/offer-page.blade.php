<x-layout>
    <div class="flex flex-row py-16 px-24">

        <div class="flex flex-col w-3/12 gap-6">
            {{-- Lewy box ze sprzedającym --}}
            <div class="bg-backgroundl mx-10 rounded-2xl py-6 px-10 w-full">
                <div>
                    <h4 class="text-3xl font-semibold uppercase">Sprzedający</h4>
                    <div class="flex flex-row mt-6">
                        <img src="/storage/{{$offer->user->profile_picture}}" alt="Zdjęcie profilowe użytkownika" class="w-20 rounded-2xl">
                        <div class="w-3/5 flex flex-col mx-6 justify-center">
                            <a href="{{ route('user.show', ['username' => $offer->user->username]) }}" class="text-primary hover-link">{{$offer->user->username}}</a>
                            {{-- TODO skontaktuj się --}}
                            <form action="{{ route('chat.create') }}" method="POST">
                                @csrf
                                <input type="hidden" name='offer_id' value="{{$offer->id}}">
                                <button type="submit" 
                                class="w-full mt-2 border border-primary text-xsm text-background bg-primary hover:bg-backgroundl hover:text-gray-200 text-md font-semibold rounded-full">
                                    Skontatuj się
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="w-full pr-2 flex flex-col mt-6 gap-4">
                    {{-- TODO dodać typ --}}
                    <x-offer.offer-attributes>
                        <p class="w-2/5">Typ: </p>
                        <p>Osoba prywatna</p>
                    </x-offer.offer-attributes>
                    @if($offer->user->name)
                        <x-offer.offer-attributes>
                            <p class="w-2/5">Imię: </p>
                            <p class="w-3/5">{{$offer->user->name}}</p>
                        </x-offer.offer-attributes>
                    @endif
                    @if($offer->user->surname)
                        <x-offer.offer-attributes>
                            <p class="w-2/5">Nazwisko: </p>
                            <p class="w-3/5">{{$offer->user->surname}}</p>
                        </x-offer.offer-attributes>
                    @endif
                    <x-offer.offer-attributes>
                        <p class="w-2/5">Email: </p>
                        <a class="text-primary hover-link w-3/5" href="mailto:{{$offer->user->email}}">{{$offer->user->email}}</a>
                    </x-offer.offer-attributes>
                    @if($offer->user->phone_number)
                        <x-offer.offer-attributes>
                            <p class="w-2/5">Telefon: </p>
                            <a class="text-primary hover-link w-3/5" href="tel:{{$offer->user->phone_number}}">{{$offer->user->phone_number}}</a>
                        </x-offer.offer-attributes>
                    @endif
                    {{-- TODO dodać realizacje --}}
                    <x-offer.offer-attributes>
                        <p class="w-2/5">Realizacje: </p>
                        <p class="w-3/5">71</p>
                    </x-offer.offer-attributes>
                    {{-- TODO dodać języki --}}
                    <x-offer.offer-attributes>
                        <p class="w-2/5">Języki: </p>
                        <div class="w-3/5 flex flex-col text-sm">
                            <p>Polski - ojczysty</p>
                            <p>Angielski - zaawansowany</p>
                        </div>
                    </x-offer.offer-attributes>
                </div>
            </div>
        </div>

        <div class="w-6/12 px-24">
            <h1 class="text-5xl ">{{$offer->title}}</h1>

            @if(!empty($offer->all_tags))
                <div class="flex flex-row gap-2 my-6 text-background">
                    @foreach(explode(',', $offer->all_tags) as $tag)
                        <x-offer.tag-tooltip tooltip="{{$tag}}">{{$tag}}</x-offer.tag-tooltip>
                    @endforeach
                </div>
            @endif
            
            <div class="mt-6 border border-primary rounded-2xl px-12 py-10">
                <p>{{$offer->description}}</p>
            </div>
        </div>

        <div class="w-3/12">
            {{-- Lewy box z ofertą --}}
            <div class="bg-backgroundl mx-10 rounded-2xl py-6 px-10 w-full">
                <div>
                    <h4 class="text-3xl font-semibold uppercase">Oferta</h4>
                    <img src="/storage/{{$offer->cover}}" alt="Okładka oferty" class="mt-4 rounded-2xl">
                    <div class="w-full pr-2 flex flex-col mt-6 gap-4">
                        <x-offer.offer-attributes>
                            <p class="w-3/5">Cena: </p>
                            <p class="w-2/5">{{$offer->price}}zł / {{$offer->price_type}}</p>
                        </x-offer.offer-attributes>
                        <x-offer.offer-attributes>
                            <p class="w-3/5">Średni czas realizacji:</p>
                            <p class="w-2/5">{{$offer->delivery_time}}</p>
                        </x-offer.offer-attributes>
                        <x-offer.offer-attributes>
                            <p class="w-3/5">Kolejka zamówień:</p>
                            <p class="w-2/5">12</p>
                        </x-offer.offer-attributes>
                        {{-- TODO link do zamówienia --}}
                        <x-buttons.success-full link='#' classes="h-10 font-semibold">Zamów</x-buttons.success-full>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>