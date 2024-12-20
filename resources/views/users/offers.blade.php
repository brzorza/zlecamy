@extends('app')

    @section('title')
        Twoje oferty
    @endsection

    @section('head')

    @endsection

    @section('content')
        <x-profile-menu>
            <div class="flex flex-col">
                <div class="w-100 mt-4 flex flex-row justify-between items-center">
                    @if($allOffers->count() > 0)
                        <h1 class="text-gray-500 text-5xl text-left mb-6 float-left">Aktywne oferty</h1>
                    @else
                        <h1 class="text-gray-500 text-5xl">Brak aktywnych ofert</h1>
                    @endif
                    <a href="{{ route('profile.offers.add') }}" class="px-6 py-2 h-fit bg-primary text-gray-700 text-xl float-right font-bold rounded-lg shadow-md hover:bg-background border-2 border-primary hover:text-gray-200">
                        <i class="fa-solid fa-plus text-lg"></i> Dodaj
                    </a>
                </div>

                <div class="w-100 min-h-96 rounded-2xl flex flex-col justify-center mt-4 px-10 py-6 bg-backgroundl">

                    <div class="w-100 grid grid-cols-4 grid-rows-2 gap-6">
                        @foreach ($allOffers as $offer)
                        <div class="bg-background rounded-xl p-4 text-white border border-background hover:border-secondary relative">
                            <div class="w-100 h-auto relative mb-2 user-offers-aspect">
                                <img src="{{$offer->cover ? asset('storage/' . $offer->cover) : asset('/images/no-image.png')}}" alt="Okładka oferty" class="absolute top-0 left-0 w-full h-full object-cover">
                            </div>
                            <h3 class="text-lg">{{$offer->title}}</h3>
                            <p class="text-md">{{$offer->category->name}}</p>
                            <p class="font-bold">{{$offer->price}} zł</p>
                            {{-- TODO aktywna nie aktywna --}}
                            {{-- @if($offer->active == 1)
                                <p class="text-right mt-2">Aktywna</p>
                            @else
                                <p class="text-right mt-2">Nie aktywna</p>
                            @endif --}}
                            {{-- TODO edit ofery --}}
                            <div class="flex flex-row items-center justify-end gap-2 mt-2">
                                <x-buttons.success link="{{ route('profile.offers.add') }}" classes='px-3 py-1 text-gray-700 text-md float-right font-bold'>
                                    <i class="fa-solid fa-pencil"></i> Edytuj
                                </x-buttons.success>
                                <button class="cursor-pointer px-3 py-1 bg-danger text-gray-300 text-md float-right font-bold rounded-md hover:bg-background border-2 border-danger hover:text-gray-200"
                                onclick="openDeleteConfirmation('{{ route('profile.offers.destroy', $offer->id) }}')">
                                    <i class="fa-solid fa-xmark"></i> Usuń
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>

            </div>
        </x-profile-menu>
    

        <div id="deleteConfirmationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-background p-6 rounded shadow-lg w-1/3">
                <p class="text-lg font-bold mb-4">Potwierdź usunięcie</p>
                <p>Czy jesteś pewny, że chcesz usunąć?</p>
                <div class="mt-4 flex justify-end space-x-4">
                    <button 
                        class="bg-danger hover:bg-dangerh text-white px-4 py-2 rounded"
                        onclick="closeDeleteConfirmation()"
                    >
                        Anuluj
                    </button>
                    <form id="deleteOfferForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-primary hover:bg-primaryh text-background px-4 py-2 rounded">
                            Usuń
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endsection

@section('script')
    <script src="{{ asset('js/deletePopup.js') }}"></script>
@endsection