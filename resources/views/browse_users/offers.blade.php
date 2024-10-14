@extends('app')

    @section('title')
        Profil
    @endsection

    @section('head')

    @endsection

    @section('content')
        <x-profile-menu username="{{$user->username}}">
            <div class="flex flex-col">

                @if($user->offers->isEmpty())
                <div class="w-100 min-h-96 rounded-2xl flex items-center justify-center mt-10 bg-backgroundl">
                    <h1 class="text-gray-500 text-5xl">Brak aktywnych ofert</h1>
                </div>
                @else

                <h1 class="text-gray-500 text-5xl text-left mb-6">Aktywne oferty <span class="text-primary font-semibold">{{$user->username}}</span></h1>
                <div class="w-100 min-h-96 rounded-2xl flex flex-col justify-center mt-10 px-10 py-6 bg-backgroundl">

                    <div class="w-100 grid grid-cols-4 grid-rows-2 gap-6">
                        @foreach ($user->offers as $offer)
                        <a href="{{ route('catalog.showSingle', ['id' => $offer->id]) }}">
                            <div class="bg-background rounded-xl p-4 text-white border border-background hover:border-secondary relative">
                                <div class="w-100 h-auto relative mb-2 user-offers-aspect">
                                    <img src="{{$offer->cover ? asset('storage/' . $offer->cover) : asset('/images/no-image.png')}}" alt="Okładka oferty" class="absolute top-0 left-0 w-full h-full object-cover">
                                </div>
                                <h3 class="text-lg">{{$offer->title}}</h3>
                                <p class="text-md">{{$offer->category->name}}</p>
                                <p class="font-bold">{{$offer->price}} zł</p>
                            </div>
                        </a>
                        @endforeach
                    </div>

                </div>
                @endif

            </div>
        </x-profile-menu>
    @endsection